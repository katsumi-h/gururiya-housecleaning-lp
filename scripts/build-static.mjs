import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const scriptDir = path.dirname(fileURLToPath(import.meta.url));
const repoDir = path.resolve(scriptDir, '..');
const sourcePath = path.join(
  repoDir,
  'wordpress',
  'page-housecleaning-sagamihara.php'
);
const outputPath = path.join(repoDir, 'index.html');

let html = fs.readFileSync(sourcePath, 'utf8');

// Contact Form 7 は静的HTMLでは動かないため、見た目の確認用に同じ構造のHTMLへ差し替える。
// CF7が出力するクラス名に合わせてあるので、LP側のCSSはそのまま効く。
const staticForm = `<form class="wpcf7-form" action="#" method="post" onsubmit="return false;">
          <p><label>お名前<span class="hc-req">必須</span>
            <input type="text" name="your-name" placeholder="例：山田 太郎"></label></p>
          <p><label>お住まいの市区町村<span class="hc-req">必須</span>
            <span class="hc-form__note">番地から先は、訪問の日程を決めるときに伺います。</span>
            <input type="text" name="your-city" placeholder="例：相模原市中央区"></label></p>
          <p><span class="hc-form__label">ご希望の場所<span class="hc-req">必須</span>
            <span class="hc-form__note">いくつでも選べます。</span></span>
            <span class="wpcf7-form-control wpcf7-checkbox">
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">浴室</span></label></span>
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">キッチン</span></label></span>
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">レンジフード</span></label></span>
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">トイレ</span></label></span>
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">エアコン</span></label></span>
              <span class="wpcf7-list-item"><label><input type="checkbox" name="your-place[]"><span class="wpcf7-list-item-label">まだ決めていない</span></label></span>
            </span></p>
          <p><label>ご希望の時期<span class="hc-req">必須</span>
            <select name="your-when">
              <option value="">選んでください</option>
              <option>できるだけ早く</option>
              <option>今月のうちに</option>
              <option>来月ごろ</option>
              <option>時期はまだ決めていない</option>
            </select></label></p>
          <p><label>メールアドレス<span class="hc-req">必須</span>
            <input type="email" name="your-email" placeholder="例：sample@example.com"></label></p>
          <p><label>電話番号<span class="hc-opt">任意</span>
            <span class="hc-form__note">お電話のほうが早い場合は、こちらへご連絡します。</span>
            <input type="tel" name="your-tel" placeholder="例：090-0000-0000"></label></p>
          <p><label>気になっていることがあればお書きください<span class="hc-opt">任意</span>
            <textarea name="your-message" placeholder="例：浴室の黒カビが何年も取れません。エプロンの中も見てもらえますか。"></textarea></label></p>
          <p><label>汚れの写真<span class="hc-opt">任意</span>
            <span class="hc-form__note">写真があると、金額をより正確にお伝えできます。</span>
            <input type="file" name="your-photo"></label></p>
          <p><input type="submit" value="この内容で相談する"></p>
        </form>`;

html = html.replace(
  /<\?php \/\* HC_FORM \*\/[\s\S]*?\?>/,
  staticForm
);

html = html
  .replace(/^<\?php[\s\S]*?\?>/, '')
  .replace(/<\?php wp_head\(\); \?>/g, '')
  .replace(
    /<body <\?php body_class\('hc-lp'\); \?>>/g,
    '<body class="hc-lp">'
  )
  .replace(/<\?php wp_body_open\(\); \?>/g, '')
  .replace(
    /<\?php echo esc_url\(home_url\('\/'\)\); \?>/g,
    'https://gururiyahonpo.com/'
  )
  .replace(
    /<\?php echo get_stylesheet_directory_uri\(\); \?>/g,
    '.'
  )
  .replace(
    /<\?php echo esc_url\(\$hc_contact_url\); \?>/g,
    '#contact'
  )
  .replace(
    /<\?php echo esc_url\(home_url\('\/tokusho\/'\)\); \?>/g,
    'https://gururiyahonpo.com/tokusho/'
  )
  .replace(
    /<\?php echo esc_url\(home_url\('\/privacy\/'\)\); \?>/g,
    'https://gururiyahonpo.com/privacy/'
  )
  .replace(/<\?php wp_footer\(\); \?>/g, '')
  .replace(
    '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
    '<meta name="viewport" content="width=device-width, initial-scale=1.0">\n  <meta name="robots" content="noindex, nofollow">'
  );

if (/<\?php/.test(html)) {
  throw new Error('静的HTMLに未変換のPHPが残っています。');
}

fs.writeFileSync(outputPath, html, 'utf8');
console.log(`静的確認版を生成しました: ${outputPath}`);

