<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CONFERENCES_ID}></th>
        <th><{$smarty.const.MB_CONFERENCES_CID}></th>
        <th><{$smarty.const.MB_CONFERENCES_TITLE}></th>
        <th><{$smarty.const.MB_CONFERENCES_SUMMARY}></th>
    </tr>
    <{foreach item=tracks from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$tracks.id}>
                <{$tracks.cid}>
                <{$tracks.title}>
                <{$tracks.summary}>
            </td>
        </tr>
    <{/foreach}>
</table>
