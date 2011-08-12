{if $app.pager.maxPage < 1}
[ページ指定が異常です]
{elseif $app.pager.count > 0}
{if $app.pager.prevPage != null}
<a href="{$script}?action_example_bbs_list=true&amp;page=1">&lt;&lt;最初</a>&nbsp;
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.prevPage}">&lt;前へ</a>
{else}
&lt;&lt;最初&nbsp;&lt;前へ
{/if}

&nbsp;{$app.pager.begin} - {$app.pager.end}件 (全{$app.pager.count}件)&nbsp;

{if $app.pager.nextPage != null}
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.nextPage}">次へ&gt;</a>&nbsp;
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.maxPage}">最後&gt;&gt;</a>
{else}
次へ&gt;&nbsp;最後&gt;&gt;
{/if}

{else}
0件 (全 0件)
{/if}
