<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Conference</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_ID}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_TITLE}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUBTITLE}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUBSUBTITLE}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_SDATE}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_EDATE}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUMMARY}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_ISDEFAULT}></th>
            <th><{$smarty.const.MD_CONFERENCES_CONFERENCE_LOGO}></th>
            <th width="80"><{$smarty.const.MD_CONFERENCES_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=conference from=$conference}>
            <tbody>
            <tr>

                <td><{$conference.id}></td>
                <td><{$conference.title}></td>
                <td><{$conference.subtitle}></td>
                <td><{$conference.subsubtitle}></td>
                <td><{$conference.sdate}></td>
                <td><{$conference.edate}></td>
                <td><{$conference.summary}></td>
                <td><{$conference.isdefault}></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/conference/<{$conference.logo}>" style="max-width:100px" alt="conference"></td>
                <td>
                    <a href="conference.php?op=view&id=<{$conference.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                    <{if $xoops_isadmin == true}>
                        <a href="conference.php?op=edit&id=<{$conference.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                        <a href="admin/conference.php?op=delete&id=<{$conference.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
