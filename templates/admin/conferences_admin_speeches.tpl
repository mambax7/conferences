<{if $speechesRows > 0}>
    <div class="outer">
        <form name="select" action="speeches.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('speechesId[]');} else if (isOneChecked('speechesId[]')) {return true;} else {alert('<{$smarty.const.AM_CONFERENCES_SELECTED_ERROR}>'); return false;}">
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


            <table class="$speeches" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectortypeid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorstime}></th>
                    <th class="left"><{$selectoretime}></th>
                    <th class="left"><{$selectorduration}></th>
                    <th class="left"><{$selectorspeakerid}></th>
                    <th class="left"><{$selectorcid}></th>
                    <th class="left"><{$selectortid}></th>
                    <th class="left"><{$selectorslides1}></th>
                    <th class="left"><{$selectorslides2}></th>
                    <th class="left"><{$selectorslides3}></th>
                    <th class="left"><{$selectorslides4}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <{foreach item=speechesArray from=$speechesArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="speeches_id[]" title="speeches_id[]" id="speeches_id[]" value="<{$speechesArray.speeches_id|default:''}>"></td>
                        <td class='left'><{$speechesArray.id}></td>
                        <td class='left'><{$speechesArray.typeid}></td>
                        <td class='left'><{$speechesArray.title}></td>
                        <td class='left'><{$speechesArray.summary}></td>
                        <td class='left'><{$speechesArray.stime}></td>
                        <td class='left'><{$speechesArray.etime}></td>
                        <td class='left'><{$speechesArray.duration}></td>
                        <td class='left'><{$speechesArray.speakerid}></td>
                        <td class='left'><{$speechesArray.cid}></td>
                        <td class='left'><{$speechesArray.tid}></td>
                        <td class='left'><{$speechesArray.slides1}></td>
                        <td class='left'><{$speechesArray.slides2}></td>
                        <td class='left'><{$speechesArray.slides3}></td>
                        <td class='left'><{$speechesArray.slides4}></td>


                        <td class="center width5"><{$speechesArray.edit_delete}></td>
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
                    <th class="left"><{$selectortypeid}></th>
                    <th class="left"><{$selectortitle}></th>
                    <th class="left"><{$selectorsummary}></th>
                    <th class="left"><{$selectorstime}></th>
                    <th class="left"><{$selectoretime}></th>
                    <th class="left"><{$selectorduration}></th>
                    <th class="left"><{$selectorspeakerid}></th>
                    <th class="left"><{$selectorcid}></th>
                    <th class="left"><{$selectortid}></th>
                    <th class="left"><{$selectorslides1}></th>
                    <th class="left"><{$selectorslides2}></th>
                    <th class="left"><{$selectorslides3}></th>
                    <th class="left"><{$selectorslides4}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $speeches</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
