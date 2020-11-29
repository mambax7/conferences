<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Speechtypes </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CONFERENCES_SPEECHTYPES_ID}></td>
            <td><{$speechtypes.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHTYPES_NAME}></td>
            <td><{$speechtypes.name}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHTYPES_COLOR}></td>
            <td><span style="background-color: <{$speechtypes.color}>;">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHTYPES_PLENARY}></td>
            <td><{$speechtypes.plenary}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEECHTYPES_LOGO}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speechtypes/<{$speechtypes.logo}>" alt="speechtypes" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_ACTION}></td>
            <td>
                <!--<a href="speechtypes.php?op=view&id=<{$speechtypes.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="speechtypes.php?op=edit&id=<{$speechtypes.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/speechtypes.php?op=delete&id=<{$speechtypes.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
