{if $app.pager.maxPage < 1}
[�ڡ������꤬�۾�Ǥ�]
{elseif $app.pager.count > 0}
{if $app.pager.prevPage != null}
<a href="{$script}?action_example_bbs_list=true&amp;page=1">&lt;&lt;�ǽ�</a>&nbsp;
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.prevPage}">&lt;����</a>
{else}
&lt;&lt;�ǽ�&nbsp;&lt;����
{/if}

&nbsp;{$app.pager.begin} - {$app.pager.end}�� (��{$app.pager.count}��)&nbsp;

{if $app.pager.nextPage != null}
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.nextPage}">����&gt;</a>&nbsp;
<a href="{$script}?action_example_bbs_list=true&amp;page={$app.pager.maxPage}">�Ǹ�&gt;&gt;</a>
{else}
����&gt;&nbsp;�Ǹ�&gt;&gt;
{/if}

{else}
0�� (�� 0��)
{/if}
