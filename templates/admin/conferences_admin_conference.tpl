<{if $conferenceRows > 0}>
    <div class="outer">
        <form name="select" action="conference.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('conferenceId[]');} else if (isOneChecked('conferenceId[]')) {return true;} else {alert('<{$smarty.const.AM_CONFERENCES_SELECTED_ERROR}>'); return false;}">
            <input type="hidden" name="confirm" value="1">
            <div class="floatleft">
                <select name="op">
                    <option value=""><{$smarty.const.AM_CONFERENCES_SELECT}></option>
                    <option value="delete"><{$smarty.const.AM_CONFERENCES_SELECTED_DELETE}></option>
                </select>
                <input id="submitUp" class="formButton" type="submit" name="submitselect" value="<{$smarty.const._SUBMIT}>" title="<{$smarty.const._SUBMIT}>">
            </div>
            <div class="floatcenter0">
                <div id="pagenav"><{$pagenav|default:''}></div>
            </div>


            <table class="$conference" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsubtitle}></th>
                    <th class="left"><{$selectorsubsubtitle}></th>
                    <th class="left"><{$selectorsdate}></th>
                    <th class="left"><{$selectoredate}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorisdefault}></th>
                    <th class="left"><{$selectorlogo}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <{foreach item=conferenceArray from=$conferenceArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="conference_id[]" title="conference_id[]" id="conference_id[]" value="<{$conferenceArray.conference_id|default:''}>"></td>
                        <td class='left'><{$conferenceArray.id}></td>
                        <td class='left'><{$conferenceArray.title}></td>
                        <td class='left'><{$conferenceArray.subtitle}></td>
                        <td class='left'><{$conferenceArray.subsubtitle}></td>
                        <td class='left'><{$conferenceArray.sdate}></td>
                        <td class='left'><{$conferenceArray.edate}></td>
                        <td class='left'><{$conferenceArray.summary}></td>
                        <td class='left'><{$conferenceArray.isdefault}></td>
                        <td class='left'><{$conferenceArray.logo}></td>


                        <td class="center width5"><{$conferenceArray.edit_delete}></td>
                    </tr>
                <{/foreach}>
            </table>
            <br>
            <br>
            <{else}>
            <table width="100%" cellspacing="1" class="outer">
                <tr>

                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsubtitle}></th>
                    <th class="left"><{$selectorsubsubtitle}></th>
                    <th class="left"><{$selectorsdate}></th>
                    <th class="left"><{$selectoredate}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorisdefault}></th>
                    <th class="left"><{$selectorlogo}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $conference</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
