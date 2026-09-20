# -*- coding: utf-8 -*-
"""Markdownで書いた記事を、WordPressへ下書きとして投稿する。

準備（1回だけ）:
  1. WordPressの管理画面 → ユーザー → プロフィール → 一番下の
     「アプリケーションパスワード」で新しいパスワードを作る（名前は claude-code など）
  2. 表示された文字列を、下のファイルに書いて保存する
       ~/.config/gururiya/wp.env
     中身（3行）:
       WP_SITE=https://gururiyahonpo.com
       WP_USER=<ログインID>
       WP_APP_PASSWORD=<表示された文字列。スペースは入れたままでよい>
  3. 他人に読まれないようにする:  chmod 600 ~/.config/gururiya/wp.env

使い方:
  python3 scripts/post-to-wp.py 記事.md                 # 下書きとして投稿
  python3 scripts/post-to-wp.py 記事.md --publish       # そのまま公開
  python3 scripts/post-to-wp.py 記事.md --dry-run       # 送らずに中身だけ確認
  python3 scripts/post-to-wp.py 記事.md --id 123        # 既存の記事を更新

記事の書き方（先頭にこの形で情報を入れる）:
  ---
  title: 相模原で浴室クリーニングを頼む前に知っておくこと
  slug: sagamihara-bathroom-cleaning
  excerpt: 浴室クリーニングの相場と、頼む前に見ておく場所をまとめました。
  ---
  本文をMarkdownで書く。
"""
import base64, json, os, re, sys, urllib.request, urllib.error

ENV = os.path.expanduser("~/.config/gururiya/wp.env")

def load_env():
    if not os.path.exists(ENV):
        sys.exit("設定ファイルがありません: %s\n  このファイルの先頭の説明を読んで作ってください。" % ENV)
    d = {}
    for line in open(ENV, encoding="utf-8"):
        line = line.strip()
        if not line or line.startswith("#") or "=" not in line: continue
        k, v = line.split("=", 1); d[k.strip()] = v.strip()
    for k in ("WP_SITE", "WP_USER", "WP_APP_PASSWORD"):
        if not d.get(k): sys.exit("%s に %s が入っていません。" % (ENV, k))
    return d

def split_front_matter(text):
    meta = {}
    m = re.match(r"^---\s*\n(.*?)\n---\s*\n", text, re.S)
    if m:
        for line in m.group(1).splitlines():
            if ":" in line:
                k, v = line.split(":", 1); meta[k.strip()] = v.strip()
        text = text[m.end():]
    return meta, text

def md_to_html(md):
    """記事に必要な範囲だけのMarkdown変換。見出し・段落・箇条書き・表・強調・リンク・引用。"""
    out, lines, i = [], md.split("\n"), 0
    def inline(s):
        s = re.sub(r"!\[([^\]]*)\]\(([^)]+)\)", r'<img src="\2" alt="\1">', s)
        s = re.sub(r"\[([^\]]+)\]\(([^)]+)\)", r'<a href="\2">\1</a>', s)
        s = re.sub(r"\*\*([^*]+)\*\*", r"<strong>\1</strong>", s)
        s = re.sub(r"`([^`]+)`", r"<code>\1</code>", s)
        return s
    while i < len(lines):
        ln = lines[i]
        if not ln.strip(): i += 1; continue
        h = re.match(r"^(#{1,4})\s+(.*)$", ln)
        if h:
            # 記事のH1は投稿タイトルが持つ。## をH2、### をH3 に合わせる
            lv = min(max(len(h.group(1)), 2), 5)
            out.append("<h%d>%s</h%d>" % (lv, inline(h.group(2)), lv)); i += 1; continue
        if re.match(r"^\s*[-*]\s+", ln):
            items = []
            while i < len(lines) and re.match(r"^\s*[-*]\s+", lines[i]):
                items.append("<li>%s</li>" % inline(re.sub(r"^\s*[-*]\s+", "", lines[i]))); i += 1
            out.append("<ul>%s</ul>" % "".join(items)); continue
        if re.match(r"^\s*\d+\.\s+", ln):
            items = []
            while i < len(lines) and re.match(r"^\s*\d+\.\s+", lines[i]):
                items.append("<li>%s</li>" % inline(re.sub(r"^\s*\d+\.\s+", "", lines[i]))); i += 1
            out.append("<ol>%s</ol>" % "".join(items)); continue
        if ln.lstrip().startswith(">"):
            body = []
            while i < len(lines) and lines[i].lstrip().startswith(">"):
                body.append(inline(lines[i].lstrip()[1:].strip())); i += 1
            out.append("<blockquote><p>%s</p></blockquote>" % "<br>".join(body)); continue
        if ln.strip().startswith("|") and i + 1 < len(lines) and re.match(r"^\s*\|[\s:|-]+\|\s*$", lines[i+1]):
            def cells(r): return [c.strip() for c in r.strip().strip("|").split("|")]
            head = cells(ln); i += 2; rows = []
            while i < len(lines) and lines[i].strip().startswith("|"):
                rows.append(cells(lines[i])); i += 1
            th = "".join("<th>%s</th>" % inline(c) for c in head)
            tb = "".join("<tr>%s</tr>" % "".join("<td>%s</td>" % inline(c) for c in r) for r in rows)
            out.append("<figure class=\"wp-block-table\"><table><thead><tr>%s</tr></thead><tbody>%s</tbody></table></figure>" % (th, tb))
            continue
        para = []
        while i < len(lines) and lines[i].strip() and not re.match(r"^(#{1,4}\s|\s*[-*]\s|\s*\d+\.\s|>|\|)", lines[i]):
            para.append(lines[i].strip()); i += 1
        out.append("<p>%s</p>" % inline("<br>".join(para)))
    return "\n\n".join(out)

def call(env, path, payload=None, method="GET"):
    url = env["WP_SITE"].rstrip("/") + "/wp-json/wp/v2/" + path
    token = base64.b64encode(("%s:%s" % (env["WP_USER"], env["WP_APP_PASSWORD"])).encode()).decode()
    data = json.dumps(payload).encode() if payload is not None else None
    req = urllib.request.Request(url, data=data, method=method, headers={
        "Authorization": "Basic " + token, "Content-Type": "application/json",
        "User-Agent": "gururiya-post/1.0"})
    try:
        return json.loads(urllib.request.urlopen(req, timeout=60).read())
    except urllib.error.HTTPError as e:
        body = e.read().decode("utf-8", "replace")[:400]
        sys.exit("WordPressがエラーを返しました（HTTP %d）\n%s" % (e.code, body))

def main():
    args = [a for a in sys.argv[1:] if not a.startswith("--")]
    flags = [a for a in sys.argv[1:] if a.startswith("--")]
    if not args: sys.exit("記事のMarkdownファイルを指定してください。")
    md = open(args[0], encoding="utf-8").read()
    meta, body = split_front_matter(md)
    title = meta.get("title") or os.path.splitext(os.path.basename(args[0]))[0]
    html = md_to_html(body)
    payload = {"title": title, "content": html,
               "status": "publish" if "--publish" in flags else "draft"}
    for k_md, k_wp in (("slug", "slug"), ("excerpt", "excerpt")):
        if meta.get(k_md): payload[k_wp] = meta[k_md]

    print("タイトル : %s" % title)
    print("状態     : %s" % ("公開" if payload["status"] == "publish" else "下書き"))
    print("本文     : %d文字 / HTML %d文字" % (len(body), len(html)))
    if "--dry-run" in flags:
        print("\n--- 変換後のHTML（先頭600文字）---\n" + html[:600]); return

    env = load_env()
    pid = None
    for i, f in enumerate(sys.argv):
        if f == "--id" and i + 1 < len(sys.argv): pid = sys.argv[i+1]
    res = call(env, "posts/%s" % pid if pid else "posts", payload, "POST")
    print("\n完了: %s" % res.get("link"))
    print("編集画面: %s/wp-admin/post.php?post=%s&action=edit" % (env["WP_SITE"].rstrip("/"), res.get("id")))

if __name__ == "__main__":
    main()
