<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Speakers</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_ID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_NAME}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_EMAIL}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_DESCRIP}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_LOCATION}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_COMPANY}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_PHOTO}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_URL}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEAKERS_HITS}></th>
            <th width="80"><{$smarty.const.MD_CONFERENCES_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=speakers from=$speakers}>
            <tbody>
            <tr>

                <td><{$speakers.id}></td>
                <td><{$speakers.name}></td>
                <td><{$speakers.email}></td>
                <td><{$speakers.descrip}></td>
                <td><{$speakers.location}></td>
                <td><{$speakers.company}></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/speakers/<{$speakers.photo}>" style="max-width:100px" alt="speakers"></td>
                <td><{$speakers.url}></td>
                <td><{$speakers.hits}></td>
                <td>
                    <a href="speakers.php?op=view&id=<{$speakers.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                    <{if $xoops_isadmin == true}>
                        <a href="speakers.php?op=edit&id=<{$speakers.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                        <a href="admin/speakers.php?op=delete&id=<{$speakers.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                    <{/if}>
                </td>
            </tr>
            </tbody>
        <{/foreach}>
    </table>
</div>
<{$pagenav|default:""}>
<{$commentsnav|default:"" }> <{$lang_notice|default:"" }>
<{if $comment_mode|default:""  == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode|default:""  == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode|default:""  == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:conferences_footer.tpl"}>
