<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Speeches </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_ID}></td>
            <td><{$speeches.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_TYPEID}></td>
            <td><{$speeches.typeid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_TITLE}></td>
            <td><{$speeches.title}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SUMMARY}></td>
            <td><{$speeches.summary}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_STIME}></td>
            <td><{$speeches.stime}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_ETIME}></td>
            <td><{$speeches.etime}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_DURATION}></td>
            <td><{$speeches.duration}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SPEAKERID}></td>
            <td><{$speeches.speakerid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_CID}></td>
            <td><{$speeches.cid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_TID}></td>
            <td><{$speeches.tid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES1}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides1}>" alt="speeches" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES2}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides2}>" alt="speeches" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES3}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides3}>" alt="speeches" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHES_SLIDES4}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speeches/<{$speeches.slides4}>" alt="speeches" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_ACTION}></td>
            <td>
                <!--<a href="speeches.php?op=view&id=<{$speeches.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="speeches.php?op=edit&id=<{$speeches.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/speeches.php?op=delete&id=<{$speeches.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
                <{/if}>
            </td>
        </tr>
        </tbody>

    </table>
</div>
<div id="pagenav"><{$pagenav}></div>
<{$commentsnav|default:"" }> <{$lang_notice|default:"" }>
<{if $comment_mode|default:"" == "flat"}> <{include file="db:system_comments_flat.tpl"}> <{elseif $comment_mode|default:""  == "thread"}> <{include file="db:system_comments_thread.tpl"}> <{elseif $comment_mode|default:""  == "nest"}> <{include file="db:system_comments_nest.tpl"}> <{/if}>
<{include file="db:conferences_footer.tpl"}>
