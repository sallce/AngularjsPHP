 <form ng-submit="sendmessage()">
        <div class="form-group">
            <label for="sendto">Send to:</label>
            <input list="user_list" name="senduser" ng-model="sendto" required/>
            <datalist id="user_list">
                <div ng-repeat="user in users">
                    <option value="{{user.username}}" userid="{{$index}}">
                </div>
            </datalist>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" ng-model="subject" required/>
        </div>
        <div class="form-group content">
            <label for="content">Content:</label>
            <textarea rows="10" cols="40" ng-model="content"  required /></textarea>
        </div>
        <input type="submit" value="submit" class="btn btn-success" />
</form>
<div ng-show="showerror">
    Please fill all fields.
</div>