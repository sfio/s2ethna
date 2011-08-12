{include file="example/bbs/_pager.tpl"}
{foreach from=$app.articles item=article}
    <hr size="1">
    <h3> {$article.subject} </h3>
    <p>¡¡<strong>Åê¹ÆÆü</strong> {$article.date} <strong>Åê¹Æ¼Ô</strong> {$article.name} [{$article.host}] </p>
    <blockquote>
      <span><pre>{$article.body}</pre></span>
    </blockquote>
{/foreach}
    <hr size="1">
{include file="example/bbs/_pager.tpl"}
