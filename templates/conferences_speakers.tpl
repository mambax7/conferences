<{include file="db:conferences_header.tpl"}>
<div class="panel panel-info">
    <div class="panel-heading"><h2 class="panel-title">Speakers </h2></div>

    <table class="table table-striped">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        <tr>

            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_ID}></td>
            <td><{$speakers.id}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_NAME}></td>
            <td><{$speakers.name}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_EMAIL}></td>
            <td><{$speakers.email}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_DESCRIP}></td>
            <td><{$speakers.descrip}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_LOCATION}></td>
            <td><{$speakers.location}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_COMPANY}></td>
            <td><{$speakers.company}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_PHOTO}></td>
            <td><img src="<{$xoops_url}>/uploads/conferences/speakers/<{$speakers.photo}>" alt="speakers" class="img-responsive"></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_URL}></td>
            <td><{$speakers.url}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_SPEAKERS_HITS}></td>
            <td><{$speakers.hits}></td>
        </tr>
        <tr>
            <td><{$smarty.const.MD_CONFERENCES_ACTION}></td>
            <td>
                <!--<a href="speakers.php?op=view&id=<{$speakers.id}>" title="<{$smarty.const._PREVIEW}>"><img src="<{xoModuleIcons16 search.png}>" alt="<{$smarty.const._PREVIEW}>" title="<{$smarty.const._PREVIEW}>"</a>&nbsp;-->
                <{if $xoops_isadmin == true}>
                    <a href="speakers.php?op=edit&id=<{$speakers.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}>" title="<{$smarty.const._EDIT}>"></a>
                    &nbsp;
                    <a href="admin/speakers.php?op=delete&id=<{$speakers.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}>" title="<{$smarty.const._DELETE}>"</a>
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
