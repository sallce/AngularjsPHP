<table class="table">
    <thead class="thead-inverse">
        <tr>
            <th>SentTo</th>
            <th>Subject</th>
            <th>Option</th>
            <!--<th>content</th>-->
        </tr>
    </thead>


    <tbody>
        <tr ng-repeat="sentmail in sendMails track by $index">
            <td>{{sentmail.username}}</td>
            <td>{{sentmail.subject}}</td>
            <!--<td>{{sentmail.content}}</td>-->
            <td>
                <important></important>
                <span class="glyphicon glyphicon-eye-open" ng-click="viewMail(sentmail.id)"></span>
                <span class="glyphicon glyphicon-trash" ng-click="deleteMail(sentmail.id,$index)"></span>
            </td>
        </tr>
    </tbody>

</table>
<div ng-show="empty_box" class="error">
  Sendbox is empty.
</div>
