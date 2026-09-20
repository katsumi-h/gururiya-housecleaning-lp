# -*- coding: utf-8 -*-
"""対応エリアの地図（images/area-map.svg）を作る。

元データ：国土数値情報 行政区域データ（国土交通省）
  https://nlftp.mlit.go.jp/ksj/gml/data/N03/
規約で出典と加工の明記が必須のため、地図の右下に入れている。

使い方:
  python3 scripts/build-area-map.py [blue|green|warm] [出力先] [zoom|wards]
"""
import json, math, os, sys, urllib.request, zipfile, io

YEAR="20240101"
CACHE=os.path.join(os.path.dirname(os.path.abspath(__file__)),"..",".mapdata")
CACHE=os.path.abspath(CACHE)

# ── 対応エリアの定義（ここだけ直せば地図が変わる） ──────────────
FULL  = {"14150":"相模原市","13209":"町田市"}                      # 全域
PART  = {"13224":"多摩市","14212":"厚木市","14401":"愛川町"}        # 一部（市町村まるごと）
WARDS = {"14137":"麻生区","14114":"瀬谷区","14117":"青葉区","14112":"旭区"}   # 一部（区単位）
# ────────────────────────────────────────────────

def fetch(pref):
    os.makedirs(CACHE, exist_ok=True)
    out=os.path.join(CACHE,"N03-%s_%s.geojson"%(YEAR,pref))
    if os.path.exists(out) and os.path.getsize(out)>100000: return out
    url="https://nlftp.mlit.go.jp/ksj/gml/data/N03/N03-2024/N03-%s_%s_GML.zip"%(YEAR,pref)
    print("ダウンロード:", url)
    data=urllib.request.urlopen(urllib.request.Request(url,headers={"User-Agent":"Mozilla/5.0"}),timeout=180).read()
    with zipfile.ZipFile(io.BytesIO(data)) as z:
        name=[n for n in z.namelist() if n.endswith(".geojson")][0]
        open(out,"wb").write(z.read(name))
    return out

def load(prefs=("13","14")):
    u={}
    for p in prefs:
        for feat in json.load(open(fetch(p),encoding="utf-8"))["features"]:
            pr=feat["properties"]; code=pr.get("N03_007")
            if not code or pr.get("N03_004")=="所属未定地": continue
            if (pr.get("N03_003") or "").endswith("支庁"): continue
            nm=(pr.get("N03_004") or "")+(pr.get("N03_005") or "")
            g=feat["geometry"]; cs=g["coordinates"]
            rings=[poly[0] for poly in (cs if g["type"]=="MultiPolygon" else [cs])]
            if not rings or min(q[1] for r in rings for q in r) < 35.05: continue
            if code in u: u[code][1].extend(rings)
            else: u[code]=[nm, list(rings)]
    # 相模原市の3区を1つにまとめる（区の境目を出さないため）
    sag=[c for c in ("14151","14152","14153") if c in u]
    if sag:
        u["14150"]=["相模原市",[r for c in sag for r in u[c][1]]]
        for c in sag: del u[c]
    # 対象でない区は市にまとめる（地図に区名が並ばないように）
    for base,name,rng in (("14100","横浜市",range(14101,14119)),("14130","川崎市",range(14131,14138))):
        rest=[str(c) for c in rng if str(c) in u and str(c) not in WARDS]
        if rest:
            u[base]=[name,[r for c in rest for r in u[c][1]]]
            for c in rest: del u[c]
    for c,nm in WARDS.items():
        if c in u: u[c][0]=nm
    return u

THEMES={
 "blue": dict(full="#2f92b3", part="#a9d9e6", other="#eef3f5", line="#ffffff",
              oline="#cfd9dd", sea="#dceef5", land="#eef0ef", ink="#20323a", stroke="#0d5c74"),
 "green":dict(full="#6aab3f", part="#b7d99a", other="#eef3ec", line="#ffffff",
              oline="#cfd9cf", sea="#d9eef5", land="#eef0ec", ink="#26332a", stroke="#3d6b22"),
 "warm": dict(full="#e07b39", part="#f6cfae", other="#f4f2ef", line="#ffffff",
              oline="#dcd6ce", sea="#dceef5", land="#f0efec", ink="#33291f", stroke="#8c4416"),
}
th=THEMES[sys.argv[1] if len(sys.argv)>1 else "blue"]
OUT=sys.argv[2] if len(sys.argv)>2 else os.path.join(os.path.dirname(os.path.abspath(__file__)),"..","images","area-map.svg")

U=load()
lo0,la0,lo1,la1 = 139.01,35.31,139.90,35.70
lat0=(la0+la1)/2; k=math.cos(math.radians(lat0))
W=1120; H=int(W*(la1-la0)/((lo1-lo0)*k))
def to_svg(p): return ((p[0]-lo0)/(lo1-lo0)*W,(la1-p[1])/(la1-la0)*H)
def thin(pts,tol):
    out=[pts[0]]
    for q in pts[1:]:
        if (q[0]-out[-1][0])**2+(q[1]-out[-1][1])**2>=tol*tol: out.append(q)
    return out if len(out)>=3 else []
def path(rings,tol=1.0,prec=1):
    f="%.0f %.0f" if prec==0 else "%.1f %.1f"
    seg=[]
    for r in rings:
        pts=thin([to_svg(p) for p in r],tol)
        if pts: seg.append("M"+"L".join(f%q for q in pts)+"Z")
    return "".join(seg)
def big(rings):
    best=None;ba=0
    for r in rings:
        pts=[to_svg(p) for p in r]
        a=abs(sum(pts[i][0]*pts[i-1][1]-pts[i-1][0]*pts[i][1] for i in range(len(pts))))/2
        if a>ba: ba=a;best=pts
    if not best: return 0,(0,0)
    return ba,(sum(q[0] for q in best)/len(best),sum(q[1] for q in best)/len(best))

S=['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d" width="%d" height="%d" role="img" aria-label="対応エリアの地図">'%(W,H,W,H),
   '<rect width="%d" height="%d" fill="%s"/>'%(W,H,th["sea"])]
jp=os.path.join(CACHE,"japan.geojson")
if not os.path.exists(jp):
    open(jp,"wb").write(urllib.request.urlopen("https://raw.githubusercontent.com/dataofjapan/land/master/japan.geojson",timeout=180).read())
S.append('<g fill="%s" stroke="%s" stroke-width="1">'%(th["land"],th["oline"]))
for f in json.load(open(jp,encoding="utf-8"))["features"]:
    if f["properties"].get("nam_ja") not in ("埼玉県","山梨県","静岡県","千葉県","群馬県","栃木県","茨城県"): continue
    g=f["geometry"];cs=g["coordinates"]
    S.append('<path d="%s"/>'%path([poly[0] for poly in (cs if g["type"]=="MultiPolygon" else [cs])],2.4,0))
S.append('</g><g stroke="%s" stroke-width="1.1" stroke-linejoin="round">'%th["line"])
for code,(nm,rings) in U.items():
    if code in FULL:              c,tol,pr = th["full"],0.9,1
    elif code in PART or code in WARDS: c,tol,pr = th["part"],1.2,1
    else:                         c,tol,pr = th["other"],2.2,0
    S.append('<path d="%s" fill="%s"/>'%(path(rings,tol,pr),c))
S.append('</g>')
labels=[]
for code,(nm,rings) in U.items():
    a,(x,y)=big(rings)
    if a<1400 or not (10<x<W-10 and 10<y<H-10): continue
    labels.append((a,x,y,nm,code))
labels.sort(reverse=True)
placed=[]
for a,x,y,nm,code in labels:
    tier = "full" if code in FULL else ("part" if (code in PART or code in WARDS) else "other")
    fs = 30 if tier=="full" else (21 if tier=="part" else 16)
    w=len(nm)*fs*1.02; h=fs*1.25
    if any(abs(x-px)<(w+pw)/2 and abs(y-py)<(h+ph)/2 for px,py,pw,ph in placed): continue
    placed.append((x,y,w,h))
    fill = "#ffffff" if tier=="full" else th["ink"]
    st   = th["stroke"] if tier=="full" else "#ffffff"
    S.append('<text x="%.0f" y="%.0f" text-anchor="middle" dominant-baseline="middle" font-family="sans-serif" font-size="%d" font-weight="%d" fill="%s" stroke="%s" stroke-width="%.1f" paint-order="stroke">%s</text>'%(x,y,fs,700 if tier!="other" else 500,fill,st,fs*0.16,nm))
for lon,lat,nm in [(139.06,35.68,"山梨県"),(139.60,35.675,"東京都"),(139.30,35.33,"神奈川県")]:
    x,y=to_svg([lon,lat])
    if 0<x<W and 0<y<H:
        S.append('<text x="%.0f" y="%.0f" text-anchor="middle" font-family="sans-serif" font-size="26" font-weight="700" fill="#8a9aa2" stroke="#ffffff" stroke-width="4" paint-order="stroke">%s</text>'%(x,y,nm))
ly=H-74
S.append('<g font-family="sans-serif" font-size="20" fill="%s"><rect x="22" y="%d" width="230" height="62" rx="8" fill="#ffffff" opacity=".88"/>'%(th["ink"],ly))
S.append('<rect x="34" y="%d" width="18" height="18" rx="3" fill="%s"/><text x="60" y="%d">全域へ伺います</text>'%(ly+10,th["full"],ly+24))
S.append('<rect x="34" y="%d" width="18" height="18" rx="3" fill="%s"/><text x="60" y="%d">一部へ伺います</text></g>'%(ly+34,th["part"],ly+48))
S.append('<text x="%d" y="%d" text-anchor="end" font-family="sans-serif" font-size="14" fill="#7d8b92">「国土数値情報（行政区域データ 2024年1月1日）」（国土交通省）を加工して作成</text></svg>'%(W-14,H-12))
open(OUT,"w",encoding="utf-8").write("".join(S))
print("%s  %dx%d  %.0f KB  市区町村 %d件 / ラベル %d件"%(OUT,W,H,os.path.getsize(OUT)/1024,len(U),len(placed)))
