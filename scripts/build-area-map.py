# -*- coding: utf-8 -*-
import json, glob, math, os, sys

FULL   = {"全域": ["相模原市","町田市"]}
PART   = ["横浜市","川崎市","多摩市","厚木市","愛川町"]

# 色（引数で切り替え）
THEMES = {
 "blue":  dict(full="#2f92b3", part="#a9d9e6", other="#eef3f5", line="#ffffff",
               olinе="#cfd9dd", sea="#dceef5", land="#eef0ef", ink="#20323a"),
 "green": dict(full="#6aab3f", part="#b7d99a", other="#eef3ec", line="#ffffff",
               olinе="#cfd9cf", sea="#d9eef5", land="#eef0ec", ink="#26332a"),
 "warm":  dict(full="#e07b39", part="#f6cfae", other="#f4f2ef", line="#ffffff",
               olinе="#dcd6ce", sea="#dceef5", land="#f0efec", ink="#33291f"),
}
theme = THEMES[sys.argv[1] if len(sys.argv)>1 else "blue"]
OUT   = sys.argv[2] if len(sys.argv)>2 else "area-map.svg"
VIEW  = sys.argv[3] if len(sys.argv)>3 else "zoom"   # zoom / full

cities={}   # 名前 -> [ring, ...]
for f in sorted(glob.glob("pref/*_*.json")):
    d=json.load(open(f)); p=d["features"][0]["properties"]
    name = p["N03_003"] if p["N03_003"].endswith("市") else p["N03_004"]
    if p["N03_003"].endswith("支庁"): continue          # 島は除く
    rings=[]
    for feat in d["features"]:
        g=feat["geometry"]; cs=g["coordinates"]
        for poly in (cs if g["type"]=="MultiPolygon" else [cs]): rings.append(poly[0])
    lats=[q[1] for r in rings for q in r]
    if min(lats) < 35.05: continue                      # 伊豆諸島・小笠原を除く
    cities.setdefault(name,[]).extend(rings)

prefs={}
for feat in json.load(open("japan.geojson"))["features"]:
    n=feat["properties"].get("nam_ja")
    if n in ("埼玉県","山梨県","静岡県","千葉県","群馬県","栃木県","茨城県"):
        g=feat["geometry"]; cs=g["coordinates"]; rings=[]
        for poly in (cs if g["type"]=="MultiPolygon" else [cs]): rings.append(poly[0])
        prefs[n]=rings

if VIEW=="zoom": lo0,la0,lo1,la1 = 139.01,35.31,139.90,35.70
else:            lo0,la0,lo1,la1 = 138.88,35.05,139.95,36.00
lat0=(la0+la1)/2; k=math.cos(math.radians(lat0))
W=1120; H=int(W*(la1-la0)/((lo1-lo0)*k))
def to_svg(p): return ((p[0]-lo0)*k/((lo1-lo0)*k)*W, (la1-p[1])/(la1-la0)*H)
def thin(pts,tol=1.0):
    out=[pts[0]]
    for q in pts[1:]:
        if (q[0]-out[-1][0])**2+(q[1]-out[-1][1])**2>=tol*tol: out.append(q)
    return out if len(out)>=3 else []
def path(rings,tol=1.0,prec=1):
    seg=[]
    fmt="M"; f=("%.0f %.0f" if prec==0 else "%.1f %.1f")
    for r in rings:
        pts=thin([to_svg(p) for p in r],tol)
        if pts: seg.append("M"+"L".join(f%q for q in pts)+"Z")
    return "".join(seg)
def area_and_center(rings):
    best=None;ba=0
    for r in rings:
        pts=[to_svg(p) for p in r]
        a=abs(sum(pts[i][0]*pts[i-1][1]-pts[i-1][0]*pts[i][1] for i in range(len(pts))))/2
        if a>ba: ba=a; best=pts
    if not best: return 0,(0,0)
    return ba,(sum(q[0] for q in best)/len(best), sum(q[1] for q in best)/len(best))

S=['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 %d %d" width="%d" height="%d" role="img" aria-label="対応エリアの地図">'%(W,H,W,H)]
S.append('<rect width="%d" height="%d" fill="%s"/>'%(W,H,theme["sea"]))
S.append('<g fill="%s" stroke="%s" stroke-width="1">'%(theme["land"],theme["olinе"]))
for n,r in prefs.items(): S.append('<path d="%s"/>'%path(r,2.4,0))
S.append('</g><g stroke="%s" stroke-width="1.1" stroke-linejoin="round">'%theme["line"])
for n,r in cities.items():
    if n in FULL["全域"]: c,tol,pr = theme["full"],0.9,1
    elif n in PART:        c,tol,pr = theme["part"],1.3,1
    else:                  c,tol,pr = theme["other"],2.2,0
    S.append('<path d="%s" fill="%s"/>'%(path(r,tol,pr),c))
S.append('</g>')
labels=[]
for n,r in cities.items():
    a,(x,y)=area_and_center(r)
    if a < 1400: continue
    if not (10<x<W-10 and 10<y<H-10): continue
    big = n in FULL["全域"]
    labels.append((a,x,y,n,big))
labels.sort(reverse=True)
placed=[]
for a,x,y,n,big in labels:
    fs = 30 if big else (21 if n in PART else 16)
    w=len(n)*fs*1.02; h=fs*1.25
    if any(abs(x-px)<(w+pw)/2 and abs(y-py)<(h+ph)/2 for px,py,pw,ph in placed): continue
    placed.append((x,y,w,h))
    fill = "#ffffff" if big else theme["ink"]
    st   = '#0d5c74' if big else "#ffffff"
    S.append('<text x="%.0f" y="%.0f" text-anchor="middle" dominant-baseline="middle" font-family="sans-serif" font-size="%d" font-weight="%d" fill="%s" stroke="%s" stroke-width="%.1f" paint-order="stroke">%s</text>'
             %(x,y,fs,700 if big or n in PART else 500,fill,st,fs*0.16,n))
# 県名
for lon,lat,nm in [(139.06,35.68,"山梨県"),(139.60,35.675,"東京都"),(139.30,35.33,"神奈川県")]:
    x,y=to_svg([lon,lat])
    if 0<x<W and 0<y<H:
        S.append('<text x="%.0f" y="%.0f" text-anchor="middle" font-family="sans-serif" font-size="26" font-weight="700" fill="#8a9aa2" stroke="#ffffff" stroke-width="4" paint-order="stroke">%s</text>'%(x,y,nm))
# 凡例
ly=H-74
S.append('<g font-family="sans-serif" font-size="20" fill="%s">'%theme["ink"])
S.append('<rect x="22" y="%d" width="230" height="62" rx="8" fill="#ffffff" opacity=".88"/>'%ly)
S.append('<rect x="34" y="%d" width="18" height="18" rx="3" fill="%s"/><text x="60" y="%d">全域へ伺います</text>'%(ly+10,theme["full"],ly+24))
S.append('<rect x="34" y="%d" width="18" height="18" rx="3" fill="%s"/><text x="60" y="%d">一部へ伺います</text>'%(ly+34,theme["part"],ly+48))
S.append('</g>')
# 出典（国土数値情報の利用規約で必須）
S.append('<text x="%d" y="%d" text-anchor="end" font-family="sans-serif" font-size="14" fill="#7d8b92">「国土数値情報（行政区域データ）」（国土交通省）を加工して作成</text>'%(W-14,H-12))
S.append('</svg>')
open(OUT,"w",encoding="utf-8").write("".join(S))
print("一部:", [n for n in PART if n in cities], "／全域:", [n for n in FULL["全域"] if n in cities])
print("%s  %dx%d  %.0f KB  市区町村 %d件 / ラベル %d件"%(OUT,W,H,os.path.getsize(OUT)/1024,len(cities),len(placed)))
