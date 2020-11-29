<table class="outer">
    <tr class="head">
        <th><{$smarty.const.MB_CONFERENCES_ID}></th>
        <th><{$smarty.const.MB_CONFERENCES_NAME}></th>
        <th><{$smarty.const.MB_CONFERENCES_EMAIL}></th>
        <th><{$smarty.const.MB_CONFERENCES_DESCRIP}></th>
        <th><{$smarty.const.MB_CONFERENCES_LOCATION}></th>
        <th><{$smarty.const.MB_CONFERENCES_COMPANY}></th>
        <th><{$smarty.const.MB_CONFERENCES_PHOTO}></th>
        <th><{$smarty.const.MB_CONFERENCES_URL}></th>
        <th><{$smarty.const.MB_CONFERENCES_HITS}></th>
    </tr>
    <{foreach item=speakers from=$block}>
        <tr class="<{cycle values = 'even,odd'}>">
            <td>
                <{$speakers.id}>
                <{$speakers.name}>
                <{$speakers.email}>
                <{$speakers.descrip}>
                <{$speakers.location}>
                <{$speakers.company}>
                <{$speakers.photo}>
                <{$speakers.url}>
                <{$speakers.hits}>
            </td>
        </tr>
    <{/foreach}>
</table>
