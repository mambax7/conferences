<{if $locationRows > 0}>
    <div class="outer">
        <form name="select" action="location.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('locationId[]');} else if (isOneChecked('locationId[]')) {return true;} else {alert('<{$smarty.const.AM_CONFERENCES_SELECTED_ERROR}>'); return false;}">
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


            <table class="$location" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectorcid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorimage}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <{foreach item=locationArray from=$locationArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="location_id[]" title="location_id[]" id="location_id[]" value="<{$locationArray.location_id|default:''}>"></td>
                        <td class='left'><{$locationArray.id}></td>
                        <td class='left'><{$locationArray.cid}></td>
                        <td class='left'><{$locationArray.title}></td>
                        <td class='left'><{$locationArray.summary}></td>
                        <td class='left'><{$locationArray.image}></td>


                        <td class="center width5"><{$locationArray.edit_delete}></td>
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
                    <th class="left"><{$selectorcid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorimage}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $location</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
