<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Conference </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_ID}></td>
            <td><{$conference.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_TITLE}></td>
            <td><{$conference.title}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUBTITLE}></td>
            <td><{$conference.subtitle}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUBSUBTITLE}></td>
            <td><{$conference.subsubtitle}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_SDATE}></td>
            <td><{$conference.sdate}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_EDATE}></td>
            <td><{$conference.edate}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_SUMMARY}></td>
            <td><{$conference.summary}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_ISDEFAULT}></td>
            <td><{$conference.isdefault}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_CONFERENCE_LOGO}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/conference/<{$conference.logo}>" alt="conference" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_ACTION}></td>
            <td>
                <!--<a href="conference.php?op=view&id=<{$conference.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="conference.php?op=edit&id=<{$conference.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/conference.php?op=delete&id=<{$conference.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
