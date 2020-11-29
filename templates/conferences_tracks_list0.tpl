<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Tracks</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CONFERENCES_TRACKS_ID}></th>
            <th><{$smarty.const.MD_CONFERENCES_TRACKS_CID}></th>
            <th><{$smarty.const.MD_CONFERENCES_TRACKS_TITLE}></th>
            <th><{$smarty.const.MD_CONFERENCES_TRACKS_SUMMARY}></th>
            <th width="80"><{$smarty.const.MD_CONFERENCES_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=tracks from=$tracks}>
            <tbody>
            <tr>

                <td><{$tracks.id}></td>
                <td><{$tracks.cid}></td>
                <td><{$tracks.title}></td>
                <td><{$tracks.summary}></td>
                <td>
                    <a href="tracks.php?op=view&id=<{$tracks.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                    <{if $xoops_isadmin == true}>
                        <a href="tracks.php?op=edit&id=<{$tracks.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                        <a href="admin/tracks.php?op=delete&id=<{$tracks.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
