<?php
/*
 * Template Name: 相模原ハウスクリーニングLP
 * Description: 枝LP①｜相模原市のハウスクリーニング
 */
$hc_contact_url = add_query_arg(
  'service',
  'housecleaning-sagamihara',
  home_url('/contact/')
);
/* Contact Form 7 のフォームID。WP管理画面でLP用フォームを作ったら、その数字を入れる。
   0 のあいだはフォームを出さず、電話のご案内だけを表示する。 */
$hc_form_id = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>相模原市のハウスクリーニング｜ぐるり屋本舗</title>
  <meta name="description" content="相模原市のハウスクリーニング。浴室・キッチン・レンジフード・トイレなど、気になる箇所からご相談ください。作業内容と金額を確認してから実施します。見積もり無料。">
  <?php wp_head(); ?>
  <style>
    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body.hc-lp {
      margin: 0;
      color: #203139;
      background: #fff;
      font-family: "Hiragino Kaku Gothic ProN", "Hiragino Sans", "Noto Sans JP", Meiryo, sans-serif;
      font-size: 16px;
      line-height: 1.8;
    }
    .hc-lp a { color: inherit; text-decoration: none; }
    .hc-lp img { display: block; max-width: 100%; height: auto; }
    .hc-lp button, .hc-lp a { -webkit-tap-highlight-color: transparent; }
    .hc-lp :focus-visible { outline: 3px solid #ef7d3b; outline-offset: 3px; }

    :root {
      --hc-ink: #203139;
      --hc-muted: #627079;
      --hc-blue: #166b83;
      --hc-blue-dark: #0d4f63;
      --hc-aqua: #e8f7f8;
      --hc-cream: #fff9ef;
      --hc-orange: #e96c2b;
      --hc-orange-dark: #bf4f18;
      --hc-line: #dce7e9;
      --hc-shadow: 0 18px 50px rgba(21, 78, 92, .12);
    }

    .hc-container { width: min(100% - 32px, 1080px); margin-inline: auto; }
    .hc-narrow { width: min(100% - 32px, 820px); margin-inline: auto; }
    .hc-section { padding: 76px 0; }
    .hc-section--tint { background: #f5fbfb; }
    .hc-section--cream { background: var(--hc-cream); }
    .hc-eyebrow {
      margin: 0 0 8px;
      color: var(--hc-blue);
      font-size: .8rem;
      font-weight: 600;
      letter-spacing: .12em;
      text-align: center;
      text-transform: uppercase;
    }
    .hc-title {
      margin: 0 0 18px;
      color: var(--hc-ink);
      font-size: clamp(1.65rem, 4vw, 2.35rem);
      line-height: 1.4;
      text-align: center;
    }
    .hc-title strong { color: var(--hc-orange-dark); }
    .hc-lead {
      max-width: 720px;
      margin: 0 auto 36px;
      color: var(--hc-muted);
      text-align: center;
    }
    .hc-note {
      margin: 18px 0 0;
      color: var(--hc-muted);
      font-size: .82rem;
      line-height: 1.7;
    }
    .hc-tag {
      display: inline-flex;
      align-items: center;
      min-height: 32px;
      padding: 5px 12px;
      border: 1px solid rgba(22, 107, 131, .25);
      border-radius: 999px;
      background: #fff;
      color: var(--hc-blue-dark);
      font-size: .78rem;
      font-weight: 600;
    }

    .hc-header {
      position: sticky;
      top: 0;
      z-index: 100;
      border-bottom: 1px solid rgba(22, 107, 131, .12);
      background: rgba(255, 255, 255, .96);
      backdrop-filter: blur(12px);
    }
    .hc-header__inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-height: 66px;
      gap: 16px;
    }
    .hc-brand { display: flex; flex-direction: column; line-height: 1.2; }
    .hc-brand__sub { color: var(--hc-blue); font-size: .68rem; font-weight: 600; }
    .hc-brand__main { color: var(--hc-ink); font-size: 1.05rem; font-weight: 600; }
    .hc-header__tel {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 44px;
      padding: 8px 16px;
      border-radius: 999px;
      background: var(--hc-orange);
      color: #fff;
      font-size: .92rem;
      font-weight: 600;
      box-shadow: 0 8px 22px rgba(233, 108, 43, .24);
    }

    .hc-hero {
      position: relative;
      overflow: hidden;
      padding: 72px 0 60px;
      background:
        radial-gradient(circle at 86% 16%, rgba(87, 201, 206, .22) 0 12%, transparent 13%),
        radial-gradient(circle at 8% 92%, rgba(233, 108, 43, .12) 0 15%, transparent 16%),
        linear-gradient(145deg, #f5ffff 0%, #fffaf2 100%);
    }
    .hc-hero::after {
      content: "";
      position: absolute;
      inset: auto -8% -130px auto;
      width: 360px;
      height: 360px;
      border: 54px solid rgba(22, 107, 131, .06);
      border-radius: 50%;
    }
    .hc-hero__grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.2fr) minmax(300px, .8fr);
      align-items: center;
      gap: 54px;
    }
    .hc-hero__area {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 18px;
      color: var(--hc-blue-dark);
      font-size: .9rem;
      font-weight: 600;
    }
    .hc-hero__area::before {
      content: "";
      width: 28px;
      height: 2px;
      background: var(--hc-orange);
    }
    .hc-hero h1 {
      margin: 0;
      font-size: clamp(2.15rem, 5.5vw, 4rem);
      line-height: 1.18;
      letter-spacing: -.035em;
    }
    .hc-hero h1 em {
      display: block;
      color: var(--hc-blue);
      font-size: .56em;
      font-style: normal;
      letter-spacing: .02em;
      margin-bottom: 10px;
    }
    .hc-hero h1 > span { display: block; }
    .hc-hero__city { font-size: .65em; }
    .hc-hero__service { font-size: 70px; }
    .hc-hero__actions { width: 100%; max-width: 620px; margin: 0 auto; }
    .hc-hero__copy {
      max-width: 650px;
      margin: 24px 0 26px;
      color: #40545e;
      font-size: 1.05rem;
    }
    .hc-tags { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 28px; }
    .hc-actions { display: flex; flex-wrap: wrap; gap: 12px; }
    .hc-button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-height: 58px;
      padding: 13px 24px;
      border: 2px solid transparent;
      border-radius: 12px;
      font-weight: 600;
      line-height: 1.35;
      text-align: center;
      transition: transform .2s ease, box-shadow .2s ease;
    }
    .hc-button:hover { transform: translateY(-2px); }
    .hc-button--primary {
      background: var(--hc-orange);
      color: #fff;
      box-shadow: 0 12px 24px rgba(233, 108, 43, .25);
    }
    .hc-button--secondary {
      border-color: var(--hc-blue);
      background: #fff;
      color: var(--hc-blue-dark);
    }
    .hc-button--primary,
    .hc-button--primary:visited,
    .hc-button--secondary,
    .hc-button--secondary:visited { color: #fff !important; }
    .hc-button small { display: block; font-size: .7rem; font-weight: 600; opacity: .92; }
    .hc-hero__panel {
      position: relative;
      padding: 30px;
      border: 1px solid rgba(22, 107, 131, .16);
      border-radius: 28px;
      background: rgba(255, 255, 255, .88);
      box-shadow: var(--hc-shadow);
    }
    .hc-hero__panel::before {
      content: "CLEAN";
      display: block;
      margin-bottom: 18px;
      color: rgba(22, 107, 131, .18);
      font-size: 2.7rem;
      font-weight: 900;
      letter-spacing: .15em;
      line-height: 1;
    }
    .hc-hero__panel h2 { margin: 0 0 12px; font-size: 1.3rem; line-height: 1.45; }
    .hc-checks { display: grid; gap: 12px; margin: 0; padding: 0; list-style: none; }
    .hc-checks li { position: relative; padding-left: 30px; color: #43555f; }
    .hc-checks li::before {
      content: "✓";
      position: absolute;
      left: 0;
      top: 2px;
      display: grid;
      place-items: center;
      width: 21px;
      height: 21px;
      border-radius: 50%;
      background: var(--hc-aqua);
      color: var(--hc-blue);
      font-size: .76rem;
      font-weight: 900;
    }
    .hc-proof {
      border-top: 1px solid var(--hc-line);
      border-bottom: 1px solid var(--hc-line);
      background: #fff;
    }
    .hc-proof__grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
    }
    .hc-proof__item {
      padding: 20px 14px;
      text-align: center;
    }
    .hc-proof__item + .hc-proof__item { border-left: 1px solid var(--hc-line); }
    .hc-proof__item strong { display: block; color: var(--hc-blue-dark); font-size: 1.02rem; }
    .hc-proof__item span { color: var(--hc-muted); font-size: .75rem; }

    .hc-card-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .hc-card {
      padding: 26px;
      border: 1px solid var(--hc-line);
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 8px 30px rgba(21, 78, 92, .06);
    }
    .hc-card__icon {
      display: grid;
      place-items: center;
      width: 46px;
      height: 46px;
      margin-bottom: 18px;
      border-radius: 14px;
      background: var(--hc-aqua);
      color: var(--hc-blue);
      font-size: 1.15rem;
      font-weight: 900;
    }
    .hc-card h3 { margin: 0 0 9px; font-size: 1.08rem; line-height: 1.5; }
    .hc-card p { margin: 0; color: var(--hc-muted); font-size: .91rem; }
    .hc-concerns-layout {
      display: grid;
      grid-template-columns: minmax(220px, .7fr) minmax(0, 1.3fr);
      align-items: start;
      gap: 36px;
    }
    .hc-concerns-intro {
      padding: 34px 30px;
      border-radius: 12px;
      background: var(--hc-blue);
      color: #fff;
      box-shadow: var(--hc-shadow);
    }
    .hc-concerns-intro strong { display: block; margin-bottom: 14px; font-size: 1.35rem; line-height: 1.55; }
    .hc-concerns-intro p { margin: 0; color: rgba(255,255,255,.88); }
    .hc-concern-list { margin: 0; padding: 0; border-top: 1px solid var(--hc-line); list-style: none; }
    .hc-concern-list li { position: relative; padding: 18px 0 18px 48px; border-bottom: 1px solid var(--hc-line); }
    .hc-concern-list li::before {
      content: "✓";
      position: absolute;
      top: 22px;
      left: 4px;
      display: grid;
      place-items: center;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: #fff3f3;
      color: var(--hc-orange);
      font-weight: 900;
    }
    .hc-concern-list h3 { margin: 0 0 5px; font-size: 1.02rem; line-height: 1.55; }
    .hc-concern-list p { margin: 0; color: var(--hc-muted); font-size: .88rem; }

    .hc-process { position: relative; display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
    .hc-process::before {
      content: "";
      position: absolute;
      top: 31px;
      right: 16%;
      left: 16%;
      height: 4px;
      background: rgba(2, 136, 209, .22);
    }
    .hc-process article { position: relative; z-index: 1; text-align: center; }
    .hc-process__no {
      display: grid;
      place-items: center;
      width: 66px;
      height: 66px;
      margin: 0 auto 20px;
      border: 6px solid #f7f8fa;
      border-radius: 50%;
      background: var(--hc-orange);
      color: #fff;
      font-size: 1rem;
      font-weight: 900;
    }
    .hc-process h3 { margin: 0 0 8px; font-size: 1.08rem; line-height: 1.5; }
    .hc-process p { margin: 0; color: var(--hc-muted); font-size: .88rem; }

    .hc-benefit-panel {
      overflow: hidden;
      padding: 40px 34px;
      border-radius: 14px;
      background: linear-gradient(135deg, var(--hc-blue), var(--hc-blue-dark));
      color: #fff;
      box-shadow: var(--hc-shadow);
    }
    .hc-benefit-panel > p { max-width: 650px; margin: 0 auto 28px; color: rgba(255,255,255,.9); text-align: center; }
    .hc-benefit-grid { display: grid; grid-template-columns: repeat(3, 1fr); }
    .hc-benefit-grid > div { padding: 0 22px; text-align: center; }
    .hc-benefit-grid > div + div { border-left: 1px solid rgba(255,255,255,.32); }
    .hc-benefit-grid strong { display: block; margin-bottom: 8px; color: #fff; font-size: 1.08rem; line-height: 1.5; }
    .hc-benefit-grid span { display: block; color: rgba(255,255,255,.82); font-size: .86rem; line-height: 1.7; }

    .hc-recommend-list {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      column-gap: 38px;
      margin: 0;
      padding: 14px 32px;
      border-top: 4px solid var(--hc-orange);
      border-radius: 10px;
      background: #fff;
      box-shadow: var(--hc-shadow);
      list-style: none;
    }
    .hc-recommend-list li { position: relative; padding: 20px 0 20px 40px; border-bottom: 1px solid var(--hc-line); font-weight: 700; }
    .hc-recommend-list li:nth-last-child(-n + 2) { border-bottom: 0; }
    .hc-recommend-list li::before {
      content: "✓";
      position: absolute;
      top: 20px;
      left: 0;
      color: var(--hc-orange);
      font-size: 1.2rem;
      font-weight: 900;
    }
    .hc-step-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .hc-step {
      position: relative;
      padding: 28px;
      border-radius: 20px;
      background: #fff;
      box-shadow: var(--hc-shadow);
    }
    .hc-step__no { color: var(--hc-orange); font-size: .78rem; font-weight: 900; letter-spacing: .08em; }
    .hc-step h3 { margin: 6px 0 8px; font-size: 1.08rem; }
    .hc-step p { margin: 0; color: var(--hc-muted); font-size: .9rem; }

    .hc-profile {
      display: grid;
      grid-template-columns: 220px 1fr;
      gap: 38px;
      align-items: center;
      padding: 36px;
      border-radius: 24px;
      background: var(--hc-blue-dark);
      color: #fff;
      box-shadow: var(--hc-shadow);
    }
    .hc-profile__mark {
      display: grid;
      place-items: center;
      aspect-ratio: 1;
      border: 1px solid rgba(255,255,255,.32);
      border-radius: 50%;
      background: rgba(255,255,255,.08);
      font-size: 4rem;
      font-weight: 900;
    }
    .hc-profile__role { margin: 0; color: #bfeaf0; font-size: .8rem; font-weight: 800; }
    .hc-profile h2 { margin: 4px 0 18px; font-size: 1.75rem; }
    .hc-profile p { margin: 0 0 12px; color: rgba(255,255,255,.88); }
    .hc-profile p:last-child { margin-bottom: 0; }
    .hc-message {
      padding: 32px;
      border-left: 5px solid var(--hc-orange);
      border-radius: 4px 18px 18px 4px;
      background: #fff;
      box-shadow: 0 10px 35px rgba(21, 78, 92, .08);
    }
    .hc-message p { margin: 0 0 14px; }
    .hc-message p:last-child { margin-bottom: 0; }

    .hc-voices { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .hc-voice {
      padding: 30px;
      border: 1px solid #f0dbc8;
      border-radius: 20px;
      background: #fff;
    }
    .hc-stars { color: #e89021; font-size: 1.05rem; letter-spacing: .08em; }
    .hc-voice blockquote { margin: 14px 0 18px; color: #344851; font-size: 1rem; }
    .hc-voice footer { color: var(--hc-muted); font-size: .82rem; }

    .hc-service-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; }
    .hc-service {
      display: flex;
      flex-direction: column;
      min-height: 250px;
      overflow: hidden;
      border: 1px solid var(--hc-line);
      border-radius: 20px;
      background: #fff;
    }
    .hc-service__top { padding: 22px 22px 14px; }
    .hc-service__label { color: var(--hc-blue); font-size: .75rem; font-weight: 900; letter-spacing: .08em; }
    .hc-service h3 { margin: 5px 0 10px; font-size: 1.15rem; }
    .hc-service p { margin: 0; color: var(--hc-muted); font-size: .86rem; }
    .hc-service__price {
      display: flex;
      align-items: baseline;
      justify-content: space-between;
      gap: 8px;
      margin-top: auto;
      padding: 15px 22px;
      background: var(--hc-aqua);
      color: var(--hc-blue-dark);
    }
    .hc-service__price strong { font-size: 1.25rem; }
    .hc-service__price span { font-size: .7rem; }
    .hc-service--wide { grid-column: span 3; min-height: auto; }
    .hc-service--wide .hc-service__top { display: grid; grid-template-columns: 1fr 2fr; gap: 24px; }

    .hc-flow { display: grid; grid-template-columns: 1fr; border-top: 2px solid var(--hc-line); counter-reset: none; }
    .hc-flow__item { display: grid; grid-template-columns: minmax(0, 1fr) minmax(280px, .8fr); align-items: center; gap: 38px; padding: 34px 22px; border: 0; border-bottom: 2px solid var(--hc-line); border-radius: 0; background: #fff; text-align: left; }
    .hc-flow__item::before { content: none; }
    .hc-flow__item h3 { margin: 0 0 12px; color: var(--hc-navy); font-size: clamp(1.3rem, 2.2vw, 1.85rem); line-height: 1.45; }
    .hc-flow__item p { margin: 0; color: var(--hc-muted); font-size: 1rem; line-height: 1.8; }
    .hc-flow__image { min-height: 180px; aspect-ratio: 16 / 10; }

    .hc-price-wrap { overflow-x: auto; border: 1px solid var(--hc-line); border-radius: 18px; background: #fff; }
    .hc-price-table { width: 100%; min-width: 680px; border-collapse: collapse; }
    .hc-price-table th, .hc-price-table td {
      padding: 16px 18px;
      border-bottom: 1px solid var(--hc-line);
      text-align: left;
      vertical-align: top;
    }
    .hc-price-table th { background: var(--hc-blue-dark); color: #fff; font-size: .8rem; }
    .hc-price-table tr:last-child td { border-bottom: 0; }
    .hc-price-table td:nth-child(2) { color: var(--hc-orange-dark); font-weight: 900; white-space: nowrap; }
    .hc-price-table small { display: block; color: var(--hc-muted); line-height: 1.5; }
    .hc-price-attention {
      margin-top: 18px;
      padding: 16px 18px;
      border-radius: 12px;
      background: #fff4e9;
      color: #70401f;
      font-size: .85rem;
    }

    .hc-faq { display: grid; gap: 12px; }
    .hc-faq details {
      border: 1px solid var(--hc-line);
      border-radius: 14px;
      background: #fff;
    }
    .hc-faq summary {
      position: relative;
      padding: 20px 52px 20px 22px;
      cursor: pointer;
      font-weight: 900;
      list-style: none;
    }
    .hc-faq summary::-webkit-details-marker { display: none; }
    .hc-faq summary::after {
      content: "+";
      position: absolute;
      right: 20px;
      top: 50%;
      color: var(--hc-blue);
      font-size: 1.4rem;
      transform: translateY(-50%);
    }
    .hc-faq details[open] summary::after { content: "−"; }
    .hc-faq__answer { padding: 0 22px 20px; color: var(--hc-muted); font-size: .91rem; }
    .hc-faq__answer p { margin: 0; }

    .hc-cta {
      padding: 54px 0;
      background: var(--hc-blue-dark);
      color: #fff;
      text-align: center;
    }
    .hc-cta h2 { margin: 0 0 12px; font-size: clamp(1.55rem, 4vw, 2.2rem); }
    .hc-cta > .hc-container > p { margin: 0 auto 24px; color: rgba(255,255,255,.78); }
    .hc-cta .hc-actions { justify-content: center; }
    .hc-bonus {
      list-style: none;
      margin: 22px auto 26px;
      padding: 0;
      max-width: 620px;
      display: grid;
      gap: 11px;
      text-align: left;
      color: rgba(255,255,255,.92);
      font-size: .97rem;
      line-height: 1.75;
    }
    .hc-bonus li { position: relative; padding-left: 26px; }
    .hc-bonus li::before {
      content: "\2713";
      position: absolute;
      left: 0;
      top: 0;
      font-weight: 700;
      color: #fff;
    }
    .hc-cta .hc-button--secondary { border-color: #fff; background: transparent; color: #fff; }

    .hc-footer { padding: 32px 0 98px; background: #17282f; color: rgba(255,255,255,.72); }
    .hc-footer__top { display: flex; justify-content: space-between; gap: 24px; }
    .hc-footer strong { color: #fff; }
    .hc-footer p { margin: 6px 0 0; font-size: .78rem; }
    .hc-footer a { text-decoration: underline; }
    .hc-area-label { margin: 24px 0 0; font-size: .86rem; font-weight: 800; color: var(--hc-blue); letter-spacing: .04em; }
    .hc-area-list { list-style: none; margin: 10px 0 0; padding: 0; display: flex; flex-wrap: wrap; gap: 10px; }
    .hc-area-chip {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 11px 18px; border: 1px solid #c9d8dc; border-radius: 999px;
      background: #fff; font-size: .95rem; font-weight: 700; color: var(--hc-ink);
    }
    .hc-area-chip span { font-size: .9em; }
    .hc-area-chip--part { font-weight: 600; background: transparent; color: var(--hc-muted); }
    .hc-image-slot--area { margin-top: 24px; aspect-ratio: 16 / 7; }
    .hc-footer__info { margin-top: 28px; padding-top: 24px; border-top: 1px solid rgba(255,255,255,.14); }
    .hc-footer__info dl { margin: 0; display: grid; gap: 10px; }
    .hc-footer__info dl > div { display: flex; gap: 18px; align-items: baseline; }
    .hc-footer__info dt { flex: 0 0 82px; color: #fff; font-weight: 800; font-size: .8rem; }
    .hc-footer__info dd { margin: 0; font-size: .82rem; line-height: 1.7; }
    .hc-footer__links { display: flex; flex-wrap: wrap; justify-content: center; gap: 22px; margin-top: 26px; padding-top: 22px; border-top: 1px solid rgba(255,255,255,.14); }
    .hc-footer__links a { color: rgba(255,255,255,.82); font-size: .82rem; }
    .hc-footer__copy { margin: 18px 0 0; text-align: center; font-size: .74rem; color: rgba(255,255,255,.5); }
    @media (max-width: 640px) {
      .hc-footer__info dl > div { flex-direction: column; gap: 2px; }
      .hc-footer__links { gap: 14px; }
    }
    .hc-sticky {
      position: fixed;
      z-index: 120;
      left: 0;
      right: 0;
      bottom: 0;
      padding: 8px max(12px, env(safe-area-inset-right)) calc(8px + env(safe-area-inset-bottom)) max(12px, env(safe-area-inset-left));
      background: rgba(255,255,255,.97);
      border-top: 2px solid var(--hc-line);
      box-shadow: 0 -8px 26px rgba(18, 60, 70, .13);
    }
    .hc-sticky__inner {
      display: flex;
      align-items: stretch;
      gap: 8px;
      width: min(100%, 1080px);
      min-height: 64px;
      margin: 0 auto;
    }
    .hc-sticky__brand {
      display: flex;
      flex: 0 0 225px;
      flex-direction: column;
      justify-content: center;
      padding-right: 16px;
      border-right: 1px solid var(--hc-line);
      color: #222;
      line-height: 1.25;
      white-space: nowrap;
    }
    .hc-sticky__brand span { color: #333; font-size: .65rem; font-weight: 500; }
    .hc-sticky__brand strong { font-size: 1.08rem; font-weight: 600; }
    .hc-sticky__tags {
      display: grid;
      flex: 0 0 280px;
      grid-template-columns: 1fr 1fr;
      align-content: center;
      gap: 4px;
      padding: 0 14px 0 6px;
      border-right: 1px solid var(--hc-line);
    }
    .hc-sticky__tags span {
      padding: 3px 8px;
      border-radius: 4px;
      background: var(--hc-blue);
      color: #fff;
      font-size: .62rem;
      font-weight: 600;
      line-height: 1.25;
      text-align: center;
      white-space: nowrap;
    }
    .hc-sticky a {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 54px;
      padding: 8px 16px;
      border-radius: 8px;
      color: #fff;
      font-size: .86rem;
      font-weight: 600;
      line-height: 1.25;
      text-align: center;
    }
    .hc-sticky__tel { flex: 0 1 280px; min-width: 0; margin-left: auto; background: var(--hc-orange); }
    .hc-sticky__tel strong { font-size: clamp(1rem, 1.6vw, 1.12rem); font-weight: 600; letter-spacing: .02em; }
    .hc-sticky__form { flex: 0 1 280px; min-width: 0; background: var(--hc-form); }
    .hc-sticky__form strong { font-weight: 600; }
    .hc-sticky__tel-mobile { display: none; }
    .hc-sticky small { display: block; margin-top: 2px; font-size: .62rem; font-weight: 400; opacity: .9; }

    @media (max-width: 860px) {
      .hc-hero__grid { grid-template-columns: 1fr; gap: 32px; }
      .hc-hero__panel { max-width: 620px; }
      .hc-concerns-layout { grid-template-columns: 1fr; }
      .hc-card-grid, .hc-step-grid, .hc-service-grid { grid-template-columns: repeat(2, 1fr); }
      .hc-service--wide { grid-column: span 2; }
      .hc-flow { grid-template-columns: 1fr; }
      .hc-flow__item { grid-template-columns: minmax(0, 1fr) minmax(220px, .8fr); gap: 24px; }
      .hc-sticky__brand, .hc-sticky__tags { display: none; }
      .hc-sticky__tel { margin-left: 0; }
    }
    @media (max-width: 640px) {
      .hc-section { padding: 56px 0; }
      .hc-header__tel { padding: 8px 12px; font-size: .78rem; }
      .hc-brand__sub { display: none; }
      .hc-hero { padding: 48px 0 44px; }
      .hc-hero__copy { font-size: .96rem; }
      .hc-actions { flex-direction: column; }
      .hc-button { width: 100%; }
      .hc-process { grid-template-columns: 1fr; gap: 26px; }
      .hc-process::before { top: 28px; right: auto; bottom: 28px; left: 27px; width: 3px; height: auto; }
      .hc-process article { display: grid; grid-template-columns: 56px 1fr; column-gap: 16px; text-align: left; }
      .hc-process__no { grid-row: 1 / 3; width: 56px; height: 56px; margin: 0; border-width: 5px; }
      .hc-benefit-panel { padding: 32px 22px; }
      .hc-benefit-grid { grid-template-columns: 1fr; }
      .hc-benefit-grid > div { padding: 18px 0; }
      .hc-benefit-grid > div + div { border-top: 1px solid rgba(255,255,255,.32); border-left: 0; }
      .hc-recommend-list { grid-template-columns: 1fr; padding-inline: 22px; }
      .hc-recommend-list li:nth-last-child(2) { border-bottom: 1px solid var(--hc-line); }
      .hc-proof__grid { grid-template-columns: 1fr; }
      .hc-proof__item + .hc-proof__item { border-top: 1px solid var(--hc-line); border-left: 0; }
      .hc-card-grid, .hc-step-grid, .hc-service-grid, .hc-voices { grid-template-columns: 1fr; }
      .hc-service--wide { grid-column: auto; }
      .hc-service--wide .hc-service__top { grid-template-columns: 1fr; gap: 4px; }
      .hc-profile { grid-template-columns: 1fr; padding: 28px; }
      .hc-profile__mark { width: 130px; }
      .hc-flow { grid-template-columns: 1fr; }
      .hc-flow__item { grid-template-columns: 1fr; gap: 18px; padding: 28px 0; }
      .hc-flow__image { min-height: 0; }
      .hc-footer__top { flex-direction: column; }
      .hc-sticky__inner { display: grid; grid-template-columns: 1fr 1fr; min-height: 0; }
      .hc-sticky__tel, .hc-sticky__form { min-width: 0; padding-inline: 8px; }
      .hc-sticky__tel strong { font-size: .9rem; }
      .hc-sticky__tel-desktop { display: none; }
      .hc-sticky__tel-mobile { display: inline; }
    }
    @media (prefers-reduced-motion: reduce) {
      html { scroll-behavior: auto; }
      .hc-button { transition: none; }
    }

    /* =========================================
       ぐるり屋本舗トップページとのブランド統一
       未確認の訴求は追加せず、色・余白・形・写真表現のみ合わせる
    ========================================= */
    :root {
      --hc-ink: #333;
      --hc-muted: #333;
      --hc-blue: #0288d1;
      --hc-blue-dark: #0277bd;
      --hc-aqua: #fff3f3;
      --hc-cream: #fff3f3;
      --hc-orange: #e53935;
      --hc-orange-dark: #c62828;
      --hc-form: #ff6b35;
      --hc-line: #e0e0e0;
      --hc-shadow: 0 4px 14px rgba(0, 0, 0, .10);
    }
    .hc-container { width: min(100% - 32px, 780px); }
    .hc-section { padding: 52px 0; }
    .hc-section--tint { background: #f7f8fa; }
    .hc-section--cream { background: #fff3f3; }
    .hc-eyebrow { display: none; }
    .hc-title {
      margin-bottom: 32px;
      color: #222;
      font-size: clamp(1.35rem, 4.5vw, 1.75rem);
      font-weight: 900;
      line-height: 1.45;
    }
    .hc-title strong { color: var(--hc-orange); }

    .hc-header {
      border-bottom: 0;
      background: var(--hc-blue);
      box-shadow: 0 2px 8px rgba(0, 0, 0, .20);
      backdrop-filter: none;
    }
    .hc-header__inner { min-height: 60px; }
    .hc-brand { flex-direction: row; align-items: baseline; gap: 6px; }
    .hc-brand__sub, .hc-brand__main { color: #fff; }
    .hc-brand__sub { font-size: .78rem; opacity: .9; }
    .hc-brand__main { font-size: 1.25rem; }
    .hc-header__tel {
      min-height: auto;
      padding: 7px 14px;
      border: 1px solid rgba(255, 255, 255, .35);
      border-radius: 6px;
      background: rgba(255, 255, 255, .15);
      box-shadow: none;
      color: #fff;
      font-size: .8rem;
    }

    .hc-hero {
      isolation: isolate;
      padding: 44px 0 52px;
      background: #173044;
      color: #fff;
    }
    .hc-hero::after { display: none; }
    .hc-hero__bg { position: absolute; inset: 0; z-index: -2; }
    .hc-hero__bg img { width: 100%; height: 100%; object-fit: cover; object-position: center top; }
    .hc-hero__bg span { position: absolute; inset: 0; background: rgba(10, 40, 64, .35); }
    .hc-hero__grid {
      grid-template-columns: 1fr;
      gap: 0;
      text-align: center;
    }
    .hc-hero__area {
      justify-content: center;
      margin-bottom: 14px;
      color: #fff;
      text-shadow: 0 1px 4px rgba(0, 0, 0, .35);
    }
    .hc-hero__area::before { background: #ffd54f; }
    .hc-tags { justify-content: center; margin-bottom: 22px; }
    .hc-tag {
      min-height: 30px;
      padding: 6px 14px;
      border: 0;
      background: var(--hc-orange);
      color: #fff;
      font-size: .75rem;
      box-shadow: 0 2px 8px rgba(198, 40, 40, .20);
    }
    .hc-hero h1 {
      color: #fff;
      font-size: clamp(1.8rem, 6vw, 2.65rem);
      line-height: 1.3;
      letter-spacing: 0;
      text-align: center;
      text-shadow: 0 2px 8px rgba(0, 0, 0, .35);
    }
    .hc-hero h1 em {
      color: #ffd54f;
      font-size: .68em;
      letter-spacing: 0;
    }
    .hc-hero__copy {
      max-width: 620px;
      margin: 18px auto 22px;
      color: rgba(255, 255, 255, .95);
      font-size: 1rem;
      font-weight: 700;
      line-height: 1.9;
      text-align: center;
      text-shadow: 0 1px 5px rgba(0, 0, 0, .35);
    }
    .hc-actions { justify-content: center; }
    .hc-hero .hc-actions > .hc-button { flex: 1 1 0; }
    .hc-button { border-radius: 10px; }
    .hc-button--primary {
      background: var(--hc-orange);
      box-shadow: 0 4px 14px rgba(229, 57, 53, .35);
    }
    .hc-button--secondary {
      border-color: transparent;
      background: var(--hc-form);
      color: #fff;
      box-shadow: 0 4px 14px rgba(255, 107, 53, .35);
    }
    .hc-hero__panel {
      width: 100%;
      max-width: 580px;
      margin: 0 auto;
      padding: 22px 24px;
      border: 0;
      border-left: 4px solid var(--hc-orange);
      border-radius: 0 10px 10px 0;
      background: rgba(255, 255, 255, .82);
      box-shadow: 0 3px 12px rgba(0, 0, 0, .12);
      color: #222;
      text-align: left;
    }
    .hc-hero__panel::before { display: none; }
    .hc-hero__panel h2 { text-align: center; }
    .hc-checks li { color: #222; font-weight: 700; }
    .hc-checks li::before { background: #e8f5e9; color: #28a745; }

    .hc-proof { border-color: var(--hc-line); }
    .hc-proof__item strong { color: var(--hc-blue); }
    .hc-card {
      border: 0;
      border-left: 4px solid var(--hc-orange);
      border-radius: 0 10px 10px 0;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .07);
    }
    .hc-card__icon { border-radius: 50%; background: #fff3f3; color: var(--hc-orange); }
    .hc-step { border-top: 4px solid var(--hc-orange); border-radius: 10px; box-shadow: var(--hc-shadow); }
    .hc-step__no { color: var(--hc-orange); }
    .hc-profile { border-radius: 12px; background: var(--hc-blue); }
    .hc-profile__role { color: rgba(255, 255, 255, .86); }
    .hc-message { border-left-color: var(--hc-orange); border-radius: 0 10px 10px 0; }
    .hc-voice { border-color: #f1c7c5; border-radius: 12px; }
    .hc-service { border-radius: 12px; }
    .hc-service__label { color: var(--hc-orange); }
    .hc-service__price { background: #fff3f3; color: var(--hc-orange-dark); }
    .hc-flow__item { border-radius: 0; }
    .hc-flow__item::before { color: var(--hc-orange); }
    .hc-price-wrap { border-radius: 10px; }
    .hc-price-table th { background: var(--hc-blue); }
    .hc-price-attention { background: #fff3f3; color: #6f2d2b; }
    .hc-faq details { border-radius: 8px; }
    .hc-faq summary::after { color: var(--hc-orange); }
    .hc-cta { background: var(--hc-blue); }
    .hc-cta .hc-button--secondary { border-color: transparent; background: var(--hc-form); color: #fff; }
    .hc-footer { background: #263238; }
    .hc-sticky { box-shadow: 0 -4px 12px rgba(0, 0, 0, .14); }
    .hc-sticky__tel { background: var(--hc-orange); }
    .hc-sticky__form { background: var(--hc-form); }

    /* 後から実写真へ差し替える画像枠。公開前に全枠を画像へ置換する。 */
    .hc-image-slot {
      position: relative;
      display: grid;
      place-items: center;
      overflow: hidden;
      border: 2px dashed #aebbc2;
      border-radius: 10px;
      background:
        linear-gradient(135deg, rgba(2, 136, 209, .07), rgba(229, 57, 53, .07)),
        repeating-linear-gradient(-45deg, rgba(255,255,255,.75) 0 12px, rgba(247,248,250,.75) 12px 24px);
      color: #52636c;
      text-align: center;
    }
    .hc-image-slot__inner { padding: 18px; }
    .hc-image-slot__icon { display: block; margin-bottom: 7px; font-size: 1.7rem; line-height: 1; }
    .hc-image-slot strong { display: block; color: #34454e; font-size: .9rem; }
    .hc-image-slot small { display: block; margin-top: 4px; font-size: .7rem; line-height: 1.5; }
    .hc-image-slot--wide { aspect-ratio: 16 / 9; margin: 0 auto 28px; }
    .hc-image-slot--profile { width: 100%; aspect-ratio: 1; border-color: rgba(255,255,255,.65); border-radius: 50%; background: rgba(255,255,255,.12); color: #fff; }
    .hc-image-slot--profile strong { color: #fff; }
    .hc-image-slot--service { aspect-ratio: 4 / 3; border-width: 0 0 2px; border-radius: 0; }
    .hc-image-slot--voice { aspect-ratio: 4 / 3; margin-bottom: 20px; }
    /* 実写真（ダミー枠と同じ場所・同じ寸法に入る） */
    .hc-photo { display: block; width: 100%; height: auto; object-fit: cover; background: #eef2f4; }
    .hc-photo--service { aspect-ratio: 4 / 3; border-bottom: 2px solid var(--hc-line); }
    .hc-photo--flow { aspect-ratio: 16 / 10; border-radius: 10px; }
    .hc-ba-wrap { margin-bottom: 36px; }
    .hc-visual-heading { margin: 0 0 16px; color: #222; font-size: 1.05rem; text-align: center; }
    .hc-ba-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .hc-ba-grid .hc-image-slot { aspect-ratio: 4 / 3; }

    /* ファーストビューの文字色・サイズ（本人指定） */
    .hc-hero h1 { color: #222; text-shadow: none; }
    .hc-hero h1 em { color: #222; }
    .hc-hero__city { color: #222; font-size: 40px; }
    .hc-hero__service { color: #e53935; }
    .hc-hero__copy { color: #222; text-shadow: none; }

    @media (max-width: 640px) {
      .hc-section { padding: 46px 0; }
      .hc-hero__city { font-size: 1.625rem; }
      .hc-hero__service { font-size: 2rem; }
      .hc-brand { flex-direction: column; align-items: flex-start; gap: 0; }
      .hc-brand__sub { display: block; font-size: .62rem; }
      .hc-brand__main { font-size: 1rem; }
      .hc-header__tel { padding: 6px 10px; font-size: .72rem; }
      .hc-hero { padding: 34px 0 42px; }
      .hc-hero__bg img { object-position: 58% top; }
      .hc-tags { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
      .hc-tag { justify-content: center; padding-inline: 8px; white-space: nowrap; }
      .hc-hero__panel { padding: 20px 16px; }
      .hc-image-slot--wide { aspect-ratio: 4 / 3; }
      .hc-ba-grid { grid-template-columns: 1fr; }
      .hc-image-slot--profile { width: 150px; }
    }

    /* 参考LPの流れに合わせ、見出し・チェックリスト・写真付き説明を使い分ける。 */
    .hc-hero__actions { margin-top: 28px; }
    .hc-hero .hc-hero__panel { max-width: 580px; }
    .hc-concerns-layout { display: block; max-width: 760px; margin-inline: auto; }
    .hc-service-grid { display: grid; grid-template-columns: 1fr; gap: 0; }
    .hc-service-grid .hc-service {
      display: grid;
      grid-template-columns: minmax(0, .85fr) minmax(0, 1.15fr);
      grid-column: auto;
      align-items: center;
      gap: 30px;
      padding: 28px 0;
      border: 0;
      border-bottom: 1px solid var(--hc-line);
      border-radius: 0;
      background: transparent;
      box-shadow: none;
    }
    .hc-service-grid .hc-service:first-child { padding-top: 0; }
    .hc-service-grid .hc-service:last-child { padding-bottom: 0; border-bottom: 0; }
    .hc-service-grid .hc-service__top { display: block; padding: 0; }
    .hc-service-grid .hc-service__top h3 { margin: 0 0 12px; font-size: 1.2rem; }
    .hc-service-grid .hc-service__top p { margin: 0; line-height: 1.85; }
    .hc-service-grid .hc-service__label { display: none; }
    .hc-service-grid .hc-image-slot--service { border: 2px dashed #aebbc2; border-radius: 10px; }
    .hc-reason-list { margin: 0; padding: 0; list-style: none; counter-reset: reasons; }
    .hc-reason-list li { display: grid; grid-template-columns: 60px 1fr; gap: 22px; padding: 28px 0; border-bottom: 1px solid var(--hc-line); counter-increment: reasons; }
    .hc-reason-list li:first-child { padding-top: 0; }
    .hc-reason-list li:last-child { padding-bottom: 0; border-bottom: 0; }
    .hc-reason-list li::before { content: counter(reasons, decimal-leading-zero); color: var(--hc-blue); font-size: 2rem; font-weight: 900; line-height: 1.3; }
    .hc-reason-list h3 { margin: 0 0 9px; font-size: 1.16rem; line-height: 1.5; }
    .hc-reason-list p { margin: 0; color: var(--hc-muted); }
    .hc-cta .hc-actions { max-width: 680px; margin-inline: auto; }
    .hc-cta .hc-actions > .hc-button { flex: 1 1 0; }
    .hc-ba-wrap { margin-bottom: 0; }
    @media (max-width: 640px) {
      .hc-hero__actions { margin-top: 28px; }
      .hc-service-grid .hc-service { grid-template-columns: 1fr; gap: 18px; }
      .hc-service-grid .hc-service__top h3 { font-size: 1.1rem; }
      .hc-reason-list li { grid-template-columns: 40px 1fr; gap: 12px; }
      .hc-reason-list li::before { font-size: 1.65rem; }
      .hc-reason-list h3 { font-size: 1.04rem; }
    }

    /* ===== FV改修（2026-09-10）：全面写真＋左へのフェード／確認事項はFV直下の3カードへ ===== */
    .hc-hero {
      position: relative;
      overflow: hidden;
      padding: 96px 0 104px;
      background: #fff;
    }
    .hc-hero::after { display: none; }
    .hc-hero__bg { position: absolute; inset: 0; z-index: 0; }
    .hc-hero__bg img { width: 100%; height: 100%; object-fit: cover; object-position: 78% center; }
    .hc-hero__bg span { display: none; }
    .hc-hero__bg::after {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(to right,
        #fff 0%,
        #fff 42%,
        rgba(255,255,255,.96) 56%,
        rgba(255,255,255,.70) 72%,
        rgba(255,255,255,.25) 88%,
        rgba(255,255,255,0) 97%);
    }
    .hc-hero__grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(0, .82fr);
      align-items: center;
      gap: 0;
    }
    .hc-hero__grid > div:first-child { max-width: 620px; }
    .hc-hero__actions { width: auto; max-width: 620px; margin: 30px 0 0; }
    .hc-hero .hc-actions { justify-content: flex-start; }

    /* FV直下の3カード（遠州総美型） */
    .hc-promises { position: relative; z-index: 2; margin-top: -52px; padding: 0; }
    .hc-promises__grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
    .hc-promise {
      background: #fff;
      border: 1px solid #c9d8dc;
      border-radius: 14px;
      padding: 10px 13px 11px;
      box-shadow: 0 4px 12px rgba(22, 107, 131, .06);
    }
    .hc-promise h2 { margin: 0 0 8px; font-size: 1.02rem; color: var(--hc-blue-dark); }
    .hc-promise p { margin: 0; font-size: .9rem; line-height: 1.75; color: #333; }

    @media (max-width: 900px) {
      .hc-hero { padding: 56px 0 64px; }
      .hc-hero__grid { grid-template-columns: 1fr; }
      .hc-hero__space { display: none; }
      .hc-hero__bg img { object-position: 68% center; }
      .hc-hero__bg::after {
        background: linear-gradient(to bottom,
          rgba(255,255,255,.95) 0%,
          rgba(255,255,255,.90) 50%,
          rgba(255,255,255,.84) 100%);
      }
      .hc-promises { margin-top: 0; padding: 26px 0 0; }
      .hc-promises__grid { grid-template-columns: 1fr; gap: 12px; }
    }
    .hc-hero__service { font-size: clamp(2.1rem, 4.4vw, 70px); white-space: nowrap; }
    .hc-hero__city { font-size: clamp(1.5rem, 2.6vw, 40px); }

    /* FVを左揃えに（2026-09-12 本人指定）。旧デザインの中央寄せ指定を打ち消す。 */
    .hc-hero__grid { text-align: left; }
    .hc-hero h1 { text-align: left; }
    .hc-hero__area { justify-content: flex-start; }
    .hc-hero__copy { margin-inline: 0; }
    .hc-hero .hc-tags { justify-content: flex-start; }
    .hc-hero .hc-actions { justify-content: flex-start; }

    @media (max-width: 900px) {
      .hc-hero__grid { text-align: left; }
      .hc-hero h1 { text-align: left; }
    }

    /* FV左揃えの取りこぼし（2026-09-12）。中央寄せの原因は text-align なので、子要素まで明示的に指定する。 */
    .hc-hero__grid,
    .hc-hero__grid > div,
    .hc-hero h1,
    .hc-hero__copy,
    .hc-hero__area { text-align: left; }
    .hc-hero__copy { margin-left: 0; margin-right: 0; max-width: 560px; }
    .hc-hero__grid > div:first-child { margin-left: 0; }

    /* ===== FV調整（2026-09-12 本人指定）：文章の開始位置を左へ／3カードをFV内へ ===== */
    /* FVのコンテナは「割合」で決める。固定pxだと幅が狭いとき画面端まで伸びてしまう。
       遠州総美の実測比率（左端11.5%・幅77%）に合わせる。 */
    .hc-hero .hc-container { width: min(77%, 1560px); margin-inline: auto; }

    .hc-hero { padding: 52px 0 40px; }
    .hc-hero__grid { align-items: start; }
    .hc-hero__grid > div:first-child { max-width: 680px; }
    .hc-hero__actions { margin: 26px 0 0; }

    /* 3カードはFVの中。写真の上に乗る */
    .hc-promises__grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
      margin-top: 40px;
      grid-column: 1 / -1;
    }
    .hc-promise {
      background: rgba(255,255,255,.94);
      backdrop-filter: blur(2px);
      border: 1px solid #c9d8dc;
      border-radius: 14px;
      padding: 9px 12px 10px;
      box-shadow: 0 4px 12px rgba(22, 107, 131, .06);
    }
    .hc-promise h2 { margin: 0 0 6px; font-size: .98rem; color: var(--hc-blue-dark); }
    .hc-promise p { margin: 0; font-size: .86rem; line-height: 1.7; color: #333; }

    @media (max-width: 900px) {
      .hc-hero .hc-container { width: min(100% - 32px, 780px); }
      .hc-hero { padding: 40px 0 36px; }
      .hc-promises__grid { grid-template-columns: 1fr; gap: 10px; margin-top: 28px; }
    }

    /* 構図を遠州総美に寄せる（2026-09-12）。余白を広げ、CTAは「塗り＋白抜き」の対比にする。 */
    .hc-hero { padding: 52px 0 40px; }
    .hc-hero h1 { margin-bottom: 26px; line-height: 1.3; }
    .hc-hero__copy { margin-top: 0; line-height: 1.9; }
    .hc-hero__actions { margin-top: 28px; gap: 14px; }
    .hc-promises__grid { margin-top: 38px; gap: 18px; }
    .hc-promise { padding: 10px 13px 11px; }

    /* 2つ目のCTAを白抜きにして、1つ目との主従をはっきりさせる */
    .hc-hero .hc-actions .hc-button--secondary,
    .hc-hero .hc-actions a.hc-button--secondary {
      background: rgba(255,255,255,.94) !important;
      color: #0277bd !important;
      border: 2px solid #0277bd !important;
      box-shadow: none;
    }

    @media (max-width: 900px) {
      .hc-hero .hc-container { width: min(100% - 32px, 780px); }
      .hc-hero { padding: 40px 0 36px; }
      .hc-promises__grid { margin-top: 30px; gap: 10px; }
    }

    /* ===== LPの型1「ゆとり型」を適用（2026-09-12）=====
       採寸元：遠州総美 enshu-sobi.jp／採寸日2026-09-12／ビューポート1280px
       型の定義：メインフォルダ/01_ナレッジ/LP制作/01_型1_ゆとり型.md
       ⚠️ ここの数値を勝手に変えない。変えたくなったら型2を作る。 */

    /* 1. コンテナ：左8.6% / 幅81.6%（必ず割合で。固定pxだと狭い画面で端まで伸びる） */
    .hc-hero .hc-container { width: min(81.6%, 1560px); margin-inline: auto; }

    /* 2. テキスト列は画面の約32.6%だけ。細くして写真を主役にする */
    .hc-hero__grid { display: block; }
    .hc-hero__grid > div:first-child { max-width: 32.6%; min-width: 300px; }
    .hc-hero__space { display: none; }

    /* 3. 文字サイズと行間 */
    .hc-hero__city   { font-size: clamp(1.4rem, 2.1vw, 27px); line-height: 1.42; }
    .hc-hero__service{ font-size: clamp(2rem, 4vw, 51.2px);   line-height: 1.42; }
    .hc-hero h1      { line-height: 1.42; margin: 0; }
    .hc-hero h1 em   { font-size: clamp(1rem, 1.65vw, 21.1px); line-height: 1.6; }
    .hc-hero__copy   { font-size: 14.7px; line-height: 1.85; max-width: 29.9%; min-width: 300px; }

    /* 4. 縦の余白：要素間は13〜17pxで詰める。CTA→カードだけ74pxで大きく空ける */
    .hc-hero h1 em      { display: block; margin-bottom: 13px; }
    .hc-hero__service   { margin-bottom: 0; }
    .hc-hero__copy      { margin: 13px 0 0; }
    .hc-hero__actions   { margin: 17px 0 0; gap: 12px; }
    .hc-promises__grid  { margin-top: 74px; gap: 12px; }

    /* 5. CTA：高さ67px・角丸999px・主従で幅を変える */
    .hc-hero .hc-actions .hc-button {
      min-height: 67px; padding: 16.8px 22.4px;
      border-radius: 999px; font-size: 16.3px; line-height: 1.8;
      flex: 0 0 auto; white-space: nowrap;
    }
    .hc-hero .hc-actions .hc-button--primary   { min-width: 353px; }
    .hc-hero .hc-actions .hc-button--secondary { min-width: 208px; }

    /* 6. カード：340×102px・角丸14px・白・すき間12px */
    .hc-promises__grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .hc-promise {
      min-height: 0; padding: 10px 13px 11px;
      border-radius: 14px; border: 1px solid #c9d8dc;
      background: #fff;
      box-shadow: 0 4px 12px rgba(22, 107, 131, .06);
    }
    .hc-promise h2 { margin: 0 0 4px; font-size: 15px; line-height: 1.5; }
    .hc-promise p  { margin: 0; font-size: 13px; line-height: 1.7; }

    .hc-hero { padding: 56px 0 44px; }

    @media (max-width: 900px) {
      .hc-hero .hc-container { width: min(100% - 32px, 780px); }
      .hc-hero__grid > div:first-child,
      .hc-hero__copy { max-width: 100%; min-width: 0; }
      .hc-hero .hc-actions .hc-button { min-width: 0; width: 100%; white-space: normal; }
      .hc-promises__grid { grid-template-columns: 1fr; margin-top: 34px; }
    }

    /* 型1の取りこぼし（2026-09-12）：CTA帯はテキスト列ではなくコンテナ全幅を使う */
    .hc-hero .hc-hero__actions {
      max-width: none !important;
      width: 100%;
      flex-wrap: nowrap;
      justify-content: flex-start;
    }

    /* 追従フッター：FVのCTAが画面から出るまで隠す（2026-09-12）
       方式は hashibami-sharoushi-site/script.js の stickyHeader と同じ
       （基準要素の getBoundingClientRect().bottom を見て is-visible を付け外しする） */
    .hc-sticky {
      transform: translateY(110%);
      opacity: 0;
      visibility: hidden;
      transition: transform .28s ease, opacity .28s ease, visibility .28s;
    }
    .hc-sticky.is-visible {
      transform: translateY(0);
      opacity: 1;
      visibility: visible;
    }
    /* 動きを減らす設定の人には、動かさず出し入れだけする */
    @media (prefers-reduced-motion: reduce) {
      .hc-sticky { transition: none; }
    }

    /* カード帯はコンテナの二重掛けを解除して、文章と左端を揃える（2026-09-12）
       型1の実測どおり、カード3枚＋すき間＝340×3＋12×2＝1044px＝コンテナ全幅81.6% */
    .hc-hero .hc-promises__grid {
      width: 100%;
      max-width: none;
      margin-left: 0;
      margin-right: 0;
    }

    /* ===== 本人指示による修正（2026-09-12・添付画像の赤入れ）===== */

    /* 2) 「神奈川エリア地域密着」を1.4倍（26.88px → 約37.6px） */
    .hc-hero__city { font-size: clamp(1.96rem, 2.94vw, 37.6px); }

    /* 3) 説明文は1文ずつ1行に収める。長い行に351px必要なので余裕をみて380px */
    .hc-hero__copy { max-width: 380px; min-width: 0; }

    /* 4) CTAボタンの大きさを統一する
       ⚠️ 型1は「主353px／従208px・同じ幅で並べない」。ここは本人指示による型1からの逸脱。 */
    .hc-hero .hc-actions .hc-button--primary,
    .hc-hero .hc-actions .hc-button--secondary {
      min-width: 320px;
      justify-content: center;
    }

    /* テキスト列の幅（2026-09-12）
       型1は32.6%（1280pxで337px）だが、見出しを1.4倍にしたら376px必要になり折れた。
       見出しが1行に収まる幅を確保する。⚠️ 型1からの逸脱。 */
    .hc-hero__grid > div:first-child { max-width: min(40%, 420px); min-width: 0; }
    .hc-hero__city { white-space: nowrap; }
    .hc-hero__copy { max-width: 400px; }

    /* カード帯を赤線（画面の約65%）より左に収める（2026-09-12 本人指示・B案）
       左端8.6% → 右端65% なので幅は56.4vw。3枚は均等（1fr）なので大きさは自動で揃う。 */
    .hc-hero .hc-promises__grid {
      max-width: 56vw;
      grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    @media (max-width: 900px) {
      .hc-hero .hc-promises__grid { max-width: none; grid-template-columns: 1fr; }
    }

    /* ===== 赤入れ2回目（2026-09-12）=====
       ①テキストを上へ寄せる ②見出し・説明文を1.4倍
       ③CTAはカードのすぐ上（少し隙間） ④カードをFVの下ギリギリまで下げる
       ⚠️ ④は「余白を詰める」だけ。FVの高さを引き伸ばしたり、カードの大きさを変えたりしない。 */

    /* ① 上へ寄せる ＋ ④ 下ギリギリまで下げる（＝上下の余白を詰める） */
    .hc-hero { padding: 24px 0 14px; }

    /* ② 1.4倍 */
    .hc-hero__city    { font-size: clamp(2.1rem, 4.1vw, 52.6px); }
    .hc-hero__service { font-size: clamp(2.6rem, 5.6vw, 71.7px); }
    .hc-hero__copy    { font-size: 20.6px; max-width: 560px; }

    /* 文字を大きくしたぶん、折り返さないように列を広げる */
    .hc-hero__grid > div:first-child { max-width: min(56%, 700px); }

    /* ③ CTAはカードのすぐ上。少しだけ隙間 */
    .hc-hero__actions { margin-top: 26px; }
    .hc-hero .hc-promises__grid { margin-top: 18px; }

    @media (max-width: 900px) {
      .hc-hero { padding: 28px 0 20px; }
      .hc-hero__city    { font-size: clamp(1.5rem, 6vw, 32px); }
      .hc-hero__service { font-size: clamp(1.9rem, 8vw, 44px); white-space: normal; }
      .hc-hero__copy    { font-size: 16px; max-width: none; }
      .hc-hero__grid > div:first-child { max-width: none; }
    }

    /* ===== 赤入れ3回目（2026-09-12）===== */

    /* ① 見出しを90%に（52.6→47.3px / 71.7→64.5px） */
    .hc-hero__city    { font-size: clamp(1.89rem, 3.69vw, 47.3px); }
    .hc-hero__service { font-size: clamp(2.34rem, 5.04vw, 64.5px); }

    /* ② 説明文の下に足した1行 */
    .hc-hero__note { display: inline-block; margin-top: 6px; font-weight: 700; }

    /* ③ メールのCTAをフッターの「フォーム受付」と同じ色に */
    .hc-hero .hc-actions .hc-button--secondary,
    .hc-hero .hc-actions a.hc-button--secondary {
      background: var(--hc-form) !important;
      color: #fff !important;
      border: 2px solid var(--hc-form) !important;
    }
    /* ===== 14. 申し込みフォーム（2026-09-20）===== */
    .hc-form { max-width: 640px; margin: 0 auto; }
    .hc-form p { margin: 0 0 18px; }
    .hc-form label { display: block; font-weight: 700; color: var(--hc-ink); }
    .hc-form__label { display: block; margin: 0 0 6px; font-weight: 700; color: var(--hc-ink); }
    .hc-req,
    .hc-opt {
      display: inline-block;
      margin-left: 8px;
      padding: 1px 7px;
      font-size: .72rem;
      line-height: 1.6;
      color: #d32f2f;
      background: #fff;
      border: 1px solid #d32f2f;
      border-radius: 4px;
      vertical-align: 2px;
    }
    .hc-req { font-weight: 700; }
    .hc-opt { font-weight: 500; }
    .hc-form__note {
      display: block;
      margin: 5px 0 0;
      font-size: .85rem;
      font-weight: 400;
      color: #333;
    }
    .hc-form input[type="text"],
    .hc-form input[type="email"],
    .hc-form input[type="tel"],
    .hc-form input[type="file"],
    .hc-form textarea,
    .hc-form select {
      width: 100%;
      margin-top: 6px;
      padding: 12px 14px;
      box-sizing: border-box;
      font-family: inherit;
      font-size: 16px;
      color: var(--hc-ink);
      background: #fff;
      border: 1px solid var(--hc-line);
      border-radius: 10px;
    }
    .hc-form textarea { min-height: 120px; line-height: 1.7; resize: vertical; }
    .hc-form input:focus,
    .hc-form textarea:focus,
    .hc-form select:focus {
      outline: none;
      border-color: var(--hc-blue);
      box-shadow: 0 0 0 3px rgba(22, 107, 131, .12);
    }
    .hc-form .wpcf7-checkbox { display: block; margin-top: 8px; }
    .hc-form .wpcf7-list-item { display: inline-block; margin: 0 14px 8px 0; }
    .hc-form .wpcf7-list-item label { display: inline-flex; align-items: center; gap: 6px; font-weight: 400; }
    .hc-form .wpcf7-list-item input[type="checkbox"] { width: 20px; height: 20px; margin: 0; accent-color: var(--hc-blue); }
    .hc-form input[type="submit"] {
      width: 100%;
      margin-top: 6px;
      padding: 17px 20px;
      font-family: inherit;
      font-size: 1.05rem;
      font-weight: 700;
      color: #fff;
      background: var(--hc-form);
      border: 2px solid var(--hc-form);
      border-radius: 999px;
      cursor: pointer;
    }
    .hc-form input[type="submit"]:hover { filter: brightness(1.05); }
    .hc-form .wpcf7-not-valid-tip { display: block; margin-top: 4px; font-size: .8rem; color: #d32f2f; }
    .hc-form .wpcf7-response-output { margin: 14px 0 0; padding: 12px 14px; border-radius: 10px; font-size: .95rem; }
    .hc-form__fallback { text-align: center; font-weight: 700; }
    .hc-form__privacy { margin: 18px 0 0; font-size: .85rem; color: #333; text-align: center; }
  </style>
</head>
<body <?php body_class('hc-lp'); ?>>
<?php wp_body_open(); ?>

<header class="hc-header">
  <div class="hc-container hc-header__inner">
    <a class="hc-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="ぐるり屋本舗 トップページ">
      <span class="hc-brand__sub">相模原市のハウスクリーニング</span>
      <span class="hc-brand__main">ぐるり屋本舗</span>
    </a>
    <a class="hc-header__tel" href="#form">✉️ お問い合わせ</a>
  </div>
</header>

<main>
  <!-- 1. 心をつかむ -->
  <section class="hc-hero">
    <div class="hc-hero__bg" aria-hidden="true">
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hero_new.png" alt="">
      <span></span>
    </div>
    <div class="hc-container hc-hero__grid">
      <div>
        <h1><span class="hc-hero__city">相模原町田エリアの</span><span class="hc-hero__service">ハウスクリーニング</span></h1>
        <p class="hc-hero__copy">何年も気になっている黒カビや油汚れはありませんか？<br>浴室だけ換気扇だけでもお受けします<br><strong class="hc-hero__note">横浜市・川崎市の一部へも伺います</strong></p>
      </div>
      <div class="hc-hero__space" aria-hidden="true"></div>
      <div class="hc-actions hc-hero__actions">
        <a class="hc-button hc-button--primary" href="tel:09021626510" data-cta-location="hero">📞 電話で聞いてみる</a>
        <a class="hc-button hc-button--secondary" href="#form">✉️ フォームで相談する</a>
      </div>
      <div class="hc-container hc-promises__grid" aria-label="ご依頼前のお約束">
        <div class="hc-promise">
          <h2>見積もりは無料</h2>
          <p>見に行くのも出張費もいただきません</p>
        </div>
        <div class="hc-promise">
          <h2>一箇所だけでOK</h2>
          <p>浴室だけ換気扇だけでも伺います</p>
        </div>
        <div class="hc-promise">
          <h2>すぐ決めなくてOK</h2>
          <p>金額を聞いてから後日でも大丈夫です</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. 共感・問題提起 -->
  <section class="hc-section">
    <div class="hc-container">
      <p class="hc-eyebrow">Your concerns</p>
      <h2 class="hc-title">こんな<strong>お掃除の悩み</strong>はありませんか？</h2>
      <div class="hc-concerns-layout">
        <ul class="hc-concern-list">
          <li><h3>こすっても黒カビが落ちない</h3><p>市販の洗剤とブラシでは表面までしか届いていない。</p></li>
          <li><h3>自分でやりたい、でも換気扇の中までは手が出せない</h3><p>人に頼むのが嫌なのではなくどこまで頼めるのか分からない。</p></li>
          <li><h3>掃除の時間を別のことに使いたい</h3><p>休みの日が掃除で終わってしまう。</p></li>
          <li><h3>掃除の見積もりに来てもらったら断りづらそう</h3><p>高くても断るのは申し訳ない気がしてそのまま頼んでしまいそう。</p></li>
          <li><h3>頼むほどじゃないと思ったまま汚れたままにしている</h3><p>「これくらいで呼んでいいのかな」といつも止まってしまう。</p></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 3. 解決方法提示 -->
  <section class="hc-section hc-section--tint">
    <div class="hc-container">
      <p class="hc-eyebrow">Our answer</p>
      <h2 class="hc-title">その<strong>お悩み</strong>にこうお答えします</h2>
      <ol class="hc-reason-list">
        <li><div><h3>お電話をいただければその場でおよその金額をお伝えします</h3><p>「浴室をお願いしたい」「2LDKです」くらいで大丈夫です。細かいことは伺ったときに確認します。</p></div></li>
        <li><div><h3>一箇所だけでも大丈夫です</h3><p>家じゅうを頼む必要はありません。いちばん気になる一箇所だけで伺います。</p></div></li>
        <li><div><h3>無理におすすめはしません</h3><p>見積もりを見て高いと思ったらそのまま断ってください。それで終わりです。</p></div></li>
      </ol>
    </div>
  </section>

  <!-- 4. ベネフィット -->
  <section class="hc-section">
    <div class="hc-container">
      <p class="hc-eyebrow">Benefits</p>
      <h2 class="hc-title"><strong>お任せ</strong>いただくとこうなります</h2>
      <ol class="hc-reason-list">
        <li><div><h3>いつも気になっていたところがきれいになります</h3><p>浴室は天井から排水口まで。換気扇はシロッコファンまで外します。</p></div></li>
        <li><div><h3>一箇所なら1〜2時間で終わります</h3><p>ずっと気にしていたことがその日のうちに終わります。</p></div></li>
        <li><div><h3>傷つけずに落とします</h3><p>古い浴槽や塗装されたところは強くこすると表面がはがれます。素材に合わせて洗剤と道具を変えます。</p></div></li>
      </ol>
    </div>
  </section>

  <!-- 5. 自分ごと -->
  <section class="hc-section hc-section--tint">
    <div class="hc-container">
      <p class="hc-eyebrow">For you</p>
      <h2 class="hc-title">こんな方から<strong>ご依頼</strong>いただいています</h2>
      <div class="hc-concerns-layout">
        <ul class="hc-concern-list">
          <li><h3>休みの日を掃除でつぶしたくない方</h3></li>
          <li><h3>やらなきゃと思いながら何か月も過ぎている方</h3></li>
          <li><h3>高い所や重いものを動かす掃除がつらくなってきた方</h3></li>
          <li><h3>お客さんが来る前に汚れている場所をきれいにしておきたい方</h3></li>
          <li><h3>家じゅうではなく気になる場所だけ頼みたい方</h3></li>
        </ul>
      </div>
    </div>
  </section>

  <!-- 6. 自己紹介 -->
  <section class="hc-section" id="profile">
    <div class="hc-container">
      <p class="hc-eyebrow">Profile</p>
      <h2 class="hc-title">ご相談を受ける人</h2>
      <div class="hc-profile">
        <div class="hc-image-slot hc-image-slot--profile" data-image-slot="profile" role="img" aria-label="代表者の写真を入れる予定"><div class="hc-image-slot__inner"><span class="hc-image-slot__icon">👤</span><strong>代表写真</strong><small>推奨：正方形／作業着・白い壁か外</small></div></div>
        <div>
          <p class="hc-profile__role">ぐるり屋本舗</p>
          <h2>樋口 勝己</h2>
          <p><strong>飲食店で30年、終業後に厨房を掃除してきました。</strong></p>
          <p>コンロの油と焦げ、蛇口の石灰、食器洗浄機に固まったカルキなど。毎日やっても、放っておけばすぐ汚れます。</p>
          <p><strong>どの洗剤と道具を使い、どういう順番でやれば良いのか。</strong>それが身についていたのが、いまの仕事につながっています。</p>
          <p>浴室、キッチン、換気扇、窓、床。どれも現場で手を入れてきた場所です。</p>
          <p>古い設備は、強くこすると塗装がはがれます。無理に作業すると部品が壊れたりします。<strong>無理なところは、無理だとお伝えします。</strong>そのうえで、できる範囲をご提案します。</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 8. お客様の声：実績が出るまで非表示（紙のアンケートで集める） -->

  <!-- 14. 申し込み -->
  <section class="hc-cta">
    <div class="hc-container">
      <h2>気になる場所からご相談ください</h2>
      <p>見積もりは無料です。出張費もいただきません。</p>
      <div class="hc-actions">
        <a class="hc-button hc-button--primary" href="tel:09021626510" data-cta-location="after-profile">📞 電話で聞いてみる</a>
        <a class="hc-button hc-button--secondary" href="#form">✉️ フォームで相談する</a>
      </div>
    </div>
  </section>

  <!-- 9. 商品説明 -->
  <section class="hc-section hc-section--tint" id="service">
    <div class="hc-container">
      <p class="hc-eyebrow">Services</p>
      <h2 class="hc-title">メニュー</h2>
      <div class="hc-service-grid">
        <article class="hc-service"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-bathroom.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="クリーニングを終えた浴槽。水垢と石鹸かすが落ちた状態"><div class="hc-service__top"><span class="hc-service__label">BATHROOM</span><h3>浴室クリーニング</h3><p><strong>天井から排水口まで。</strong>自分ではやりにくい場所を専用の洗剤と道具で洗います。</p><p><strong>洗う場所</strong>／浴槽・天井・壁・床・ドア・鏡・蛇口・金具・排水口・照明・換気扇のまわり・小物</p><p><strong>作業時間の目安：約2時間</strong></p><p>水垢や石鹸かすで白くなっていた浴槽やタイルから元の色が出てきます。黒カビも取れます。</p></div></article>
        <article class="hc-service"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-kitchen.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="キッチンクリーニングで洗うシンク・蛇口・調理台・コンロ・レンジフード"><div class="hc-service__top"><span class="hc-service__label">KITCHEN</span><h3>キッチンクリーニング</h3><p><strong>油と水あかを両方落とします。</strong>キッチンは汚れの種類が多いので場所ごとに洗剤を使い分けます。</p><p><strong>洗う場所</strong>／シンク・排水口・蛇口・調理台・コンロ・魚焼きグリル（中まで）・収納の扉（外側）・窓の内側</p><p><strong>作業時間の目安：約2時間</strong></p><p>油で黒ずんでいたコンロと白く曇っていたシンクから元の色が出てきます。</p></div></article>
        <article class="hc-service"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-range-hood.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="油がついたレンジフードのフィルター。分解して洗う"><div class="hc-service__top"><span class="hc-service__label">RANGE HOOD</span><h3>レンジフード（換気扇）クリーニング</h3><p><strong>換気扇は分解洗浄します。</strong>フードの中にたまった油は外さないとふいても落ちません。</p><p><strong>洗う場所</strong>／フィルター・中のファン・ファンのまわり・本体の外側</p><p><strong>作業時間の目安：約1時間</strong></p><p>茶色い油の膜が取れてファン本来の金属の色が出てきます。</p></div></article>
        <article class="hc-service"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-toilet.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="クリーニングを終えたトイレ。便器・便座・床まで洗った状態"><div class="hc-service__top"><span class="hc-service__label">TOILET</span><h3>トイレクリーニング</h3><p><strong>便器の中も外も床と壁まで洗います。</strong></p><p><strong>洗う場所</strong>／便器・便座・ウォシュレットのノズル・タンクの表面と手洗い・ペーパーホルダー・収納の扉（外側）・壁・床・幅木・換気口の表面</p><p><strong>作業時間の目安：約1時間</strong></p><p>便器のふちの黒ずみとたまっている水のまわりについた汚れが取れます。排水管やトイレ特有の臭いも汚れと一緒になくなります。</p></div></article>
        <article class="hc-service"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-air-conditioner.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="クリーニングを終えた壁掛けエアコン"><div class="hc-service__top"><span class="hc-service__label">AIR CONDITIONER</span><h3>エアコンクリーニング</h3><p><strong>風を送り出す部分（クロスフローファン）には、カビやホコリがたまりやすく黒い汚れが付着します。</strong>見える部分だけでなく汚れがたまりやすい内部までしっかり洗浄します。</p><p><strong>洗う場所</strong>／フィルター・送風ファン・熱交換器・吹き出し口・ルーバー・本体カバー</p><p><strong>作業時間の目安：約2時間</strong></p><p>表面だけではなくカビや汚れがたまりやすい内部までしっかり洗浄します。</p></div></article>
        <article class="hc-service hc-service--wide"><img class="hc-photo hc-photo--service" src="<?php echo get_stylesheet_directory_uri(); ?>/images/service-other.jpg" width="1200" height="900" loading="lazy" decoding="async" alt="クリーニングを終えた洗面台。窓やサッシなどもご相談いただけます"><div class="hc-service__top"><div><span class="hc-service__label">OTHER</span><h3>そのほかのご相談</h3></div><p>窓・サッシ・網戸、<strong>家じゅうまとめて</strong>、引っ越しの前後なども承ります。<strong>金額は、お部屋を見てからお伝えします。</strong>まずはご相談ください。</p></div></article>
      </div>
    </div>
  </section>

  <!-- 10. 特徴・選ばれる理由 -->
  <section class="hc-section" id="reasons">
    <div class="hc-container">
      <p class="hc-eyebrow">Why us</p>
      <h2 class="hc-title">先にお伝えしていること</h2>
      <ol class="hc-reason-list">
        <li><div><h3>当日伺う人は事前にお伝えします</h3><p>知らない人が突然立っていることはありません。</p></div></li>
        <li><div><h3>その日に決めていただくことはありません</h3><p>気になる場所が見つかればお伝えします。頼むかどうかは後日で構いません。</p></div></li>
        <li><div><h3>遅れそうなときは必ず連絡します</h3><p>連絡がないままお待たせすることはしません。</p></div></li>
        <li><div><h3>始める前に一緒に見ます</h3><p>どこをどう洗うか作業の前にお伝えします。気になっている場所があればそのとき教えてください。</p></div></li>
        <li><div><h3>終わる前に一緒に見ていただきます</h3><p>気になるところがあればその場で直します。</p></div></li>
      </ol>
    </div>
  </section>

  <!-- 11. 不安や疑問（FAQ） -->
  <section class="hc-section hc-section--cream" id="faq">
    <div class="hc-narrow">
      <p class="hc-eyebrow">FAQ</p>
      <h2 class="hc-title">よくあるご質問</h2>
      <div class="hc-faq">
        <details><summary>どのくらい前に連絡すればいいですか？</summary><div class="hc-faq__answer"><p>手が空いていれば最短で翌日に伺えます。ただ、早めにご連絡いただけるほど準備と段取りができます。先に一度伺ってご相談しながら金額を決めることもできます。</p></div></details>
        <details><summary>対応エリアの外なのですが頼めますか？</summary><div class="hc-faq__answer"><p>お受けします。その場合は交通費を別にいただきます。まずはご相談ください。</p></div></details>
        <details><summary>表示されている金額から変わることはありますか？</summary><div class="hc-faq__answer"><p>伺って洗う場所と金額を決めてからお伝えします。決めたあとはお客様から追加のご依頼がない限り変わりません。作業の日に金額が上がることはありません。</p></div></details>
        <details><summary>作業の前に片付けは必要ですか？</summary><div class="hc-faq__answer"><p>片付けは要りません。ただ、洗う場所に置いてあるものだけ先にどけていただけると助かります。室内のお荷物にはできるだけ触れずに作業するよう心がけています。</p></div></details>
        <details><summary>作業の間は家にいなければいけませんか？</summary><div class="hc-faq__answer"><p>いらっしゃらなくても大丈夫です。お出かけになる場合は始める前と終わったあとの写真をお送りしてお電話でご報告します。</p></div></details>
        <details><summary>小さい子どもやペットがいても頼めますか？</summary><div class="hc-faq__answer"><p>大丈夫です。先に教えていただければそれに合わせて作業します。</p></div></details>
        <details><summary>洗剤のにおいは残りますか？</summary><div class="hc-faq__answer"><p>ふだんはにおいのない洗剤を使います。汚れがひどい場所には強い洗剤を使うことがあり、そのときはにおいが残り換気が必要になることもあります。強い洗剤を使うときは必ず先にお伝えして確認してから使います。</p></div></details>
        <details><summary>汚れは全部落ちますか？</summary><div class="hc-faq__answer"><p>落ちない汚れもあります。素材にしみ込んでしまったり面が傷んで変わってしまった色は洗っても戻りません。見て分かるものは作業の前や作業中にお伝えします。あとから「落ちませんでした」と言うことはしません。</p></div></details>
        <details><summary>女性の一人暮らしですが不安です。大丈夫ですか？</summary><div class="hc-faq__answer"><p>当日伺う人は事前にお伝えします。身分証をお見せしてから家に上がります。入る場所も先にお伝えします。お伝えした場所以外には入りません。作業の間ずっと見ていただいて構いません。</p></div></details>
      </div>
    </div>
  </section>

  <!-- 12. 金額 -->
  <section class="hc-section" id="price">
    <div class="hc-container">
      <p class="hc-eyebrow">Price</p>
      <h2 class="hc-title">料金</h2>
      <div class="hc-price-wrap">
        <table class="hc-price-table">
          <thead><tr><th>メニュー</th><th>税込料金</th><th>作業時間の目安</th></tr></thead>
          <tbody>
            <tr><td>浴室クリーニング</td><td>19,800円（税込）〜</td><td>約2時間</td></tr>
            <tr><td>キッチンクリーニング</td><td>19,800円（税込）〜</td><td>約2時間</td></tr>
            <tr><td>レンジフード（換気扇）クリーニング</td><td>19,800円（税込）〜</td><td>約1時間</td></tr>
            <tr><td>トイレクリーニング</td><td>16,500円（税込）〜</td><td>約1時間</td></tr>
            <tr><td>エアコンクリーニング（1台）</td><td>13,200円（税込）〜</td><td>約2時間</td></tr>
          </tbody>
        </table>
      </div>
      <div class="hc-price-wrap">
        <table class="hc-price-table">
          <thead><tr><th>セット</th><th>税込料金</th><th>お得額</th></tr></thead>
          <tbody>
            <tr><td>浴室＋トイレ</td><td>33,800円（税込）〜</td><td>1か所ずつ頼むより<strong>2,500円お得</strong></td></tr>
            <tr><td>浴室＋キッチン＋レンジフード</td><td>53,400円（税込）〜</td><td>1か所ずつ頼むより<strong>6,000円お得</strong></td></tr>
          </tbody>
        </table>
      </div>
      <div class="hc-price-wrap">
        <table class="hc-price-table">
          <thead><tr><th>オプション</th><th>税込料金</th><th>補足</th></tr></thead>
          <tbody>
            <tr><td>エプロン内部の洗浄（浴室）</td><td>5,500円（税込）</td><td>浴槽の横のカバーを外して内側を洗います</td></tr>
            <tr><td>換気扇内部の洗浄（浴室）</td><td>3,300円（税込）</td><td>―</td></tr>
          </tbody>
        </table>
      </div>
      <p class="hc-price-attention">表示はすべて<strong>税込</strong>です。汚れの状態によっては、<strong>追加の料金をいただくことがあります。</strong>金額は、<strong>見積もりのときに、内容をご説明したうえで決めます。決まった金額から、あとで増えることはありません。</strong></p>
      <p class="hc-note">駐車スペースをご用意いただける場合、駐車場代はかかりません。コインパーキングを使用する場合は、利用実費を別途お願いします。</p>
      <p class="hc-note"><strong>お支払いは現金のみです。</strong>領収書をお出しします。</p>
      <p class="hc-note"><strong>キャンセルは無料です。</strong>作業の前日までにお見積もりをした場合は作業の前日まで、作業当日にお見積もりをした場合は作業を始めるまで、お金はいただきません。日程の変更は前日までにご連絡ください。</p>
    </div>
  </section>

  <!-- 対応エリア -->
  <section class="hc-section hc-section--tint" id="area">
    <div class="hc-container">
      <p class="hc-eyebrow">Service area</p>
      <h2 class="hc-title">相模原エリア中心にお伺いします</h2>
      <p class="hc-lead">相模原市と町田市は全域へ伺います。そのほかのエリアも、場所によってお受けできます。</p>
      <p class="hc-area-label">全域へ伺います</p>
      <ul class="hc-area-list">
        <li class="hc-area-chip"><span aria-hidden="true">📍</span>相模原市</li>
        <li class="hc-area-chip"><span aria-hidden="true">📍</span>町田市</li>
      </ul>
      <p class="hc-area-label">一部のエリアへ伺います</p>
      <ul class="hc-area-list">
        <li class="hc-area-chip hc-area-chip--part"><span aria-hidden="true">📍</span>横浜市</li>
        <li class="hc-area-chip hc-area-chip--part"><span aria-hidden="true">📍</span>川崎市</li>
        <li class="hc-area-chip hc-area-chip--part"><span aria-hidden="true">📍</span>多摩市</li>
        <li class="hc-area-chip hc-area-chip--part"><span aria-hidden="true">📍</span>厚木市</li>
        <li class="hc-area-chip hc-area-chip--part"><span aria-hidden="true">📍</span>愛川町</li>
      </ul>
      <p class="hc-note">一部のエリアは、場所によってお受けできないことがあります。お電話で住所をお聞きしてお答えします。</p>
      <div class="hc-image-slot hc-image-slot--area" data-image-slot="area-map" role="img" aria-label="対応エリアの地図を入れる予定"><div class="hc-image-slot__inner"><span class="hc-image-slot__icon">🗺️</span><strong>対応エリアの地図</strong><small>推奨：横長／相模原市・町田市・厚木市・多摩市・愛川町を色分け</small></div></div>
      <p class="hc-note">エリアの外は、交通費を別にいただきます。</p>
    </div>
  </section>

  <!-- 14. 申し込み -->
  <section class="hc-cta">
    <div class="hc-container">
      <h2>気になる場所からご相談ください</h2>
      <p>見積もりは無料です。出張費もいただきません。</p>
      <div class="hc-actions">
        <a class="hc-button hc-button--primary" href="tel:09021626510" data-cta-location="after-price">📞 電話で聞いてみる</a>
        <a class="hc-button hc-button--secondary" href="#form">✉️ フォームで相談する</a>
      </div>
    </div>
  </section>

  <!-- 15. ご依頼の流れ -->
  <section class="hc-section" id="flow">
    <div class="hc-container">
      <h2 class="hc-title">ご依頼の流れ</h2>
      <p class="hc-lead">お問い合わせからお支払いまで4つのステップです</p>
      <div class="hc-flow">
        <article class="hc-flow__item"><div><h3>01　お問い合わせ</h3><p>お電話またはフォームからご連絡ください。<strong>お電話ならその場でおよその金額をお伝えします。</strong>気になる場所とお部屋の広さなどを教えてください。<br>電話 090-2162-6510（9:00〜19:00・年中無休）／フォームは24時間受け付けています。</p></div><img class="hc-photo hc-photo--flow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-contact.jpg" width="1100" height="688" loading="lazy" decoding="async" alt="スマートフォンから問い合わせているところ"></article>
        <article class="hc-flow__item"><div><h3>02　お見積もり</h3><p><strong>無料です。出張費もいただきません。</strong>ご希望の場所を見て洗う場所と金額をお伝えします。汚れの状態で追加の料金が必要な場合もこの時にご説明します。<strong>作業内容と金額を書いた紙（見積り）をお渡しします。その場で決めていただく必要はありません。</strong><br>※お見積もりは作業の前日までに行う場合と、作業当日に行う場合があります。</p></div><img class="hc-photo hc-photo--flow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-quote.jpg" width="1100" height="688" loading="lazy" decoding="async" alt="見積もりのイメージ。家の模型と電卓"></article>
        <article class="hc-flow__item"><div><h3>03　クリーニング</h3><p><strong>始める前にどこをどう洗うかを一緒に見ます。</strong>立ち会いは最初と最後だけで大丈夫です。途中でお出かけになっても構いません。<strong>ずっとお留守の場合は始める前と終わったあとの写真をお送りしてお電話でご報告します。</strong></p></div><div class="hc-image-slot hc-flow__image" data-image-slot="flow-cleaning" role="img" aria-label="クリーニング作業のイメージ画像を入れる予定"><div class="hc-image-slot__inner"><span>🧹</span><strong>クリーニング作業の画像</strong><small>ダミー画像／後で差し替え</small></div></div></article>
        <article class="hc-flow__item"><div><h3>04　お支払い</h3><p><strong>作業が終わった後に一緒に見ていただきます。</strong>気になるところがあればその場で直します。仕上がりをご確認いただいてから、<strong>現金</strong>でお支払いください。<strong>領収書もお出しします。</strong></p></div><img class="hc-photo hc-photo--flow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/flow-payment.jpg" width="1100" height="688" loading="lazy" decoding="async" alt="現金でのお支払いのイメージ"></article>
      </div>
    </div>
  </section>

  <!-- 16. 最後に -->
  <section class="hc-section">
    <div class="hc-container">
      <p class="hc-eyebrow">Finally</p>
      <h2 class="hc-title">最後に</h2>
      <div class="hc-message">
        <p><strong>いつも気になっていたと思います。</strong><br>目に入るたびに「そのうちやろう」と思いながら、そのままになってきたのではないでしょうか。</p>
        <p><strong>洗ってしまえば1〜2時間の作業で終わります。</strong><br>いつも気になっていたことがその日のうちに片づきます。</p>
        <p><strong>一番気になってる場所から始めてください、浴室だけ換気扇だけから。</strong></p>
        <p><strong>「この汚れ落ちますか」だけでも構いません。</strong><br>お願いするかどうかは私の話を聞いてから決めていただいて大丈夫です。</p>
      </div>
    </div>
  </section>

  <!-- 14. 申し込み -->
  <section class="hc-cta">
    <div class="hc-container">
      <h2>気になる場所からご相談ください</h2>
      <p>見積もりは無料です。出張費もいただきません。</p>
      <div class="hc-actions">
        <a class="hc-button hc-button--primary" href="tel:09021626510" data-cta-location="final">📞 電話で聞いてみる</a>
        <a class="hc-button hc-button--secondary" href="#form">✉️ フォームで相談する</a>
      </div>
    </div>
  </section>

  <!-- 14. 申し込みフォーム -->
  <section class="hc-section hc-section--tint" id="form">
    <div class="hc-container">
      <p class="hc-eyebrow">Contact</p>
      <h2 class="hc-title">フォームでご相談ください</h2>
      <p class="hc-lead">見積もりは無料です。出張費もいただきません。<br>いただいた内容は、ご相談のためだけに使います。</p>
      <div class="hc-form">
        <?php /* HC_FORM */ echo $hc_form_id ? do_shortcode('[contact-form-7 id="' . (int) $hc_form_id . '"]') : '<p class="hc-form__fallback">ただいまフォームを準備しています。お急ぎの方は <a href="tel:09021626510">090-2162-6510</a> へお電話ください。</p>'; ?>
        <p class="hc-form__privacy">いただいた内容の扱いは<a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a>をご覧ください。</p>
      </div>
    </div>
  </section>

</main>

<footer class="hc-footer">
  <div class="hc-container hc-footer__top">
    <div><strong>ぐるり屋本舗</strong><p>代表：樋口勝己</p></div>
    <div><strong><a href="tel:09021626510" data-cta-location="footer">090-2162-6510</a></strong><p>受付 9:00〜19:00・年中無休</p></div>
  </div>
  <div class="hc-container hc-footer__info">
    <dl>
      <div><dt>屋号</dt><dd>ぐるり屋本舗</dd></div>
      <div><dt>代表</dt><dd>樋口勝己</dd></div>
      <div><dt>所在地</dt><dd>請求があった場合、遅滞なく開示いたします</dd></div>
      <div><dt>対応エリア</dt><dd>相模原市・町田市（全域）／横浜市・川崎市・多摩市・厚木市・愛川町（一部）</dd></div>
      <div><dt>電話</dt><dd><a href="tel:09021626510" data-cta-location="footer-info">090-2162-6510</a></dd></div>
      <div><dt>受付時間</dt><dd>9:00〜19:00（年中無休）</dd></div>
    </dl>
  </div>
  <div class="hc-container hc-footer__links">
    <a href="<?php echo esc_url(home_url('/tokusho/')); ?>">特定商取引法に基づく表記</a>
    <a href="<?php echo esc_url(home_url('/privacy/')); ?>">プライバシーポリシー</a>
    <a href="<?php echo esc_url($hc_contact_url); ?>">お問い合わせ</a>
  </div>
  <p class="hc-footer__copy">&copy; 2026 ぐるり屋本舗 All Rights Reserved.</p>
</footer>

<nav class="hc-sticky" aria-label="お問い合わせ">
  <div class="hc-sticky__inner">
    <div class="hc-sticky__brand">
      <span>相模原市のハウスクリーニング</span>
      <strong>ぐるり屋本舗</strong>
    </div>
    <div class="hc-sticky__tags" aria-label="受付・対応条件">
      <span>現地確認無料</span>
      <span>年中無休</span>
      <span>事前に料金確認</span>
      <span>見積もり無料</span>
    </div>
    <a class="hc-sticky__tel" href="tel:09021626510" data-cta-location="sticky"><strong><span class="hc-sticky__tel-desktop">📞 090-2162-6510</span><span class="hc-sticky__tel-mobile">📞 電話で相談</span></strong><small>9:00〜19:00</small></a>
    <a class="hc-sticky__form" href="#form"><strong>フォーム受付</strong><small>見積もり無料</small></a>
  </div>
</nav>

<script>
(function() {
  window.dataLayer = window.dataLayer || [];

  document.addEventListener('click', function(event) {
    var target = event.target;
    if (!target.closest && target.parentElement) target = target.parentElement;
    if (!target.closest) return;

    var phoneLink = target.closest('a[href^="tel:"]');
    if (!phoneLink) return;

    window.dataLayer.push({
      event: 'phone_click',
      site_name: 'gururiyahonpo',
      service_name: 'housecleaning_sagamihara',
      page_path: window.location.pathname,
      link_location: phoneLink.getAttribute('data-cta-location') || 'unknown'
    });
  }, true);
})();
</script>

<?php wp_footer(); ?>

<script>
// 追従フッター：FVのCTAボタンが画面から出たら表示する。
// はしばみのサイト（script.js の stickyHeader）と同じ考え方。
(function () {
  var bar = document.querySelector('.hc-sticky');
  var anchor = document.querySelector('.hc-hero__actions') || document.querySelector('.hc-hero');
  if (!bar || !anchor) return;

  // CTAが上端に近づいた時点で出す。「完全に消えてから」だと遅い（2026-09-12 本人指定）。
  // ヘッダー（60px）に隠れ始める位置＋余裕40px＝100px。
  // ※ヘッダーを毎回 querySelector で測る方式にしたら、ページの状態によって
  //   282px を拾うことがあり、しきい値がぶれた。固定値にしてある。
  var SHOW_AT = 100;

  function update() {
    bar.classList.toggle('is-visible', anchor.getBoundingClientRect().bottom < SHOW_AT);
  }
  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', update, { passive: true });
  update();
})();
</script>
</body>
</html>
