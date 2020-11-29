<{if $speechtypesRows > 0}>
    <div class="outer">
        <form name="select" action="speechtypes.php?op=" method="POST"
              onsubmit="if(window.document.select.op.value =='') {return false;} else if (window.document.select.op.value =='delete') {return deleteSubmitValid('speechtypesId[]');} else if (isOneChecked('speechtypesId[]')) {return true;} else {alert('<{$smarty.const.AM_CONFERENCES_SELECTED_ERROR}>'); return false;}">
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


            <table class="$speechtypes" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <th align="center" width="5%"><input name="allbox" title="allbox" id="allbox" onclick="xoopsCheckAll('select', 'allbox');" type="checkbox" title="Check All" value="Check All"></th>
                    <th class="left"><{$selectorid}></th>
                    <th class="left"><{$selectorname}></th>
                    <th class="center"><{$selectorcolor}></th>
                    <th class="center"><{$selectorplenary}></th>
                    <th class="left"><{$selectorlogo}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <{foreach item=speechtypesArray from=$speechtypesArrays}>
                    <tr class="<{cycle values="odd,even"}>">

                        <td align="center" style="vertical-align:middle;"><input type="checkbox" name="speechtypes_id[]" title="speechtypes_id[]" id="speechtypes_id[]" value="<{$speechtypesArray.speechtypes_id|default:''}>"></td>
                        <td class='left'><{$speechtypesArray.id}></td>
                        <td class='left'><{$speechtypesArray.name}></td>
                        <td class='center'><{$speechtypesArray.color}></td>
                        <td class='center'><{$speechtypesArray.plenary}></td>
                        <td class='left'><{$speechtypesArray.logo}></td>


                        <td class="center width5"><{$speechtypesArray.edit_delete}></td>
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
                    <th class="center"><{$selectorcolor}></th>
                    <th class="center"><{$selectorplenary}></th>
                    <th class="left"><{$selectorlogo}></th>

                    <th class="center width5"><{$smarty.const.AM_CONFERENCES_FORM_ACTION}></th>
                </tr>
                <tr>
                    <td class="errorMsg" colspan="11">There are no $speechtypes</td>
                </tr>
            </table>
    </div>
    <br>
    <br>
<{/if}>
