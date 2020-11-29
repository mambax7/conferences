<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title"><strong>Speeches</strong></h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_ID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_TYPEID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_TITLE}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SUMMARY}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_STIME}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_ETIME}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_DURATION}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SPEAKERID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_CID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_TID}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES1}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES2}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES3}></th>
            <th><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES4}></th>
            <th width="80"><{$smarty.const.MD_CONFERENCES_ACTION}></th>
        </tr>
        </thead>
        <{foreach item=speeches from=$speeches}>
            <tbody>
            <tr>

                <td><{$speeches.id}></td>
                <td><{$speeches.typeid}></td>
                <td><{$speeches.title}></td>
                <td><{$speeches.summary}></td>
                <td><{$speeches.stime}></td>
                <td><{$speeches.etime}></td>
                <td><{$speeches.duration}></td>
                <td><{$speeches.speakerid}></td>
                <td><{$speeches.cid}></td>
                <td><{$speeches.tid}></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides1}>" style="max-width:100px" alt="speeches"></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides2}>" style="max-width:100px" alt="speeches"></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides3}>" style="max-width:100px" alt="speeches"></td>
                <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides4}>" style="max-width:100px" alt="speeches"></td>
                <td>
                    <a href="speeches.php?op=view&id=<{$speeches.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>
                    <{if $xoops_isadmin == true}>
                        <a href="speeches.php?op=edit&id=<{$speeches.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                        <a href="admin/speeches.php?op=delete&id=<{$speeches.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
