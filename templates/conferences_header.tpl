<div class="header">
    <span class="left"><b><{$smarty.const.MD_CONFERENCES_TITLE}></b>&#58;&#160;</span>
    <span class="left"><{$smarty.const.MD_CONFERENCES_DESC}></span><br>
</div>
<div class="head">
    <{if $adv != ''}>
        <div class="center"><{$adv}></div>
    <{/if}>
</div>
<br>
<ul class="nav nav-pills">
    <li class="active"><a href="<{$conferences_url}>"><{$smarty.const.MD_CONFERENCES_INDEX}></a></li>

    <li><a href="<{$conferences_url}>/speakers.php"><{$smarty.const.MD_CONFERENCES_SPEAKERS}></a></li>
    <li><a href="<{$conferences_url}>/speeches.php"><{$smarty.const.MD_CONFERENCES_SPEECHES}></a></li>
    <li><a href="<{$conferences_url}>/speechtypes.php"><{$smarty.const.MD_CONFERENCES_SPEECHTYPES}></a></li>
    <li><a href="<{$conferences_url}>/tracks.php"><{$smarty.const.MD_CONFERENCES_TRACKS}></a></li>
    <li><a href="<{$conferences_url}>/conference.php"><{$smarty.const.MD_CONFERENCES_CONFERENCE}></a></li>
    <li><a href="<{$conferences_url}>/location.php"><{$smarty.const.MD_CONFERENCES_LOCATION}></a></li>
</ul>

<br>
