<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CONFERENCES_ID}></th>
        <th><{$smarty.const.MB_CONFERENCES_TYPEID}></th>
        <th><{$smarty.const.MB_CONFERENCES_TITLE}></th>
        <th><{$smarty.const.MB_CONFERENCES_SUMMARY}></th>
        <th><{$smarty.const.MB_CONFERENCES_STIME}></th>
        <th><{$smarty.const.MB_CONFERENCES_ETIME}></th>
        <th><{$smarty.const.MB_CONFERENCES_DURATION}></th>
        <th><{$smarty.const.MB_CONFERENCES_SPEAKERID}></th>
        <th><{$smarty.const.MB_CONFERENCES_CID}></th>
        <th><{$smarty.const.MB_CONFERENCES_TID}></th>
        <th><{$smarty.const.MB_CONFERENCES_SLIDES1}></th>
        <th><{$smarty.const.MB_CONFERENCES_SLIDES2}></th>
        <th><{$smarty.const.MB_CONFERENCES_SLIDES3}></th>
        <th><{$smarty.const.MB_CONFERENCES_SLIDES4}></th>
    </tr>
    <{foreach item=speeches from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$speeches.id}>
                <{$speeches.typeid}>
                <{$speeches.title}>
                <{$speeches.summary}>
                <{$speeches.stime}>
                <{$speeches.etime}>
                <{$speeches.duration}>
                <{$speeches.speakerid}>
                <{$speeches.cid}>
                <{$speeches.tid}>
                <{$speeches.slides1}>
                <{$speeches.slides2}>
                <{$speeches.slides3}>
                <{$speeches.slides4}>
            </td>
        </tr>
    <{/foreach}>
</table>
