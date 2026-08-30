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

