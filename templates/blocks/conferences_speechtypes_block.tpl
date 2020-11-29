<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CONFERENCES_ID}></th>
        <th><{$smarty.const.MB_CONFERENCES_NAME}></th>
        <th><{$smarty.const.MB_CONFERENCES_COLOR}></th>
        <th><{$smarty.const.MB_CONFERENCES_PLENARY}></th>
        <th><{$smarty.const.MB_CONFERENCES_LOGO}></th>
    </tr>
    <{foreach item=speechtypes from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$speechtypes.id}>
                <{$speechtypes.name}>
                <{$speechtypes.color}>
                <{$speechtypes.plenary}>
                <{$speechtypes.logo}>
            </td>
        </tr>
    <{/foreach}>
</table>
