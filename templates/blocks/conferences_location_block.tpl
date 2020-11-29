<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CONFERENCES_ID}></th>
        <th><{$smarty.const.MB_CONFERENCES_CID}></th>
        <th><{$smarty.const.MB_CONFERENCES_TITLE}></th>
        <th><{$smarty.const.MB_CONFERENCES_SUMMARY}></th>
        <th><{$smarty.const.MB_CONFERENCES_IMAGE}></th>
    </tr>
    <{foreach item=location from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$location.id}>
                <{$location.cid}>
                <{$location.title}>
                <{$location.summary}>
                <{$location.image}>
            </td>
        </tr>
    <{/foreach}>
</table>
