<{if $speakersRows > 0}>
    <div class="outer">
        <form name="select" action="speakers.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('speakersId[]');} else if (isOneChecked('speakersId[]')) {return true;} else {alert('<{$smarty.const.AM_CONFERENCES_SELECTED_ERROR}>'); return false;}">
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


            <table class="$speakers" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectorname}></th>
                    <th class="left"><{$selectoremail}></th>
                    <th class="left"><{$selectordescrip}></th>
                    <th class="left"><{$selectorlocation}></th>
                    <th class="left"><{$selectorcompany}></th>
                    <th class="left"><{$selectorphoto}></th>
                    <th class="left"><{$selectorurl}></th>
                    <th class="center"><{$selectorhits}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <{foreach item=speakersArray from=$speakersArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="speakers_id[]" title="speakers_id[]" id="speakers_id[]" value="<{$speakersArray.speakers_id|default:''}>"></td>
                        <td class='left'><{$speakersArray.id}></td>
                        <td class='left'><{$speakersArray.name}></td>
                        <td class='left'><{$speakersArray.email}></td>
                        <td class='left'><{$speakersArray.descrip}></td>
                        <td class='left'><{$speakersArray.location}></td>
                        <td class='left'><{$speakersArray.company}></td>
                        <td class='left'><{$speakersArray.photo}></td>
                        <td class='left'><{$speakersArray.url}></td>
                        <td class='center'><{$speakersArray.hits}></td>


                        <td class="center width5"><{$speakersArray.edit_delete}></td>
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
                    <th class="left"><{$selectorname}></th>
                    <th class="left"><{$selectoremail}></th>
                    <th class="left"><{$selectordescrip}></th>
                    <th class="left"><{$selectorlocation}></th>
                    <th class="left"><{$selectorcompany}></th>
                    <th class="left"><{$selectorphoto}></th>
                    <th class="left"><{$selectorurl}></th>
                    <th class="center"><{$selectorhits}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $speakers</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
