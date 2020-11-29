<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Location </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CONFERENCES_LOCATION_ID}></td>
            <td><{$location.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_LOCATION_CID}></td>
            <td><{$location.cid}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_LOCATION_TITLE}></td>
            <td><{$location.title}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_LOCATION_SUMMARY}></td>
            <td><{$location.summary}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_LOCATION_IMAGE}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/location/<{$location.image}>" alt="location" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_ACTION}></td>
            <td>
                <!--<a href="location.php?op=view&id=<{$location.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="location.php?op=edit&id=<{$location.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/location.php?op=delete&id=<{$location.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
