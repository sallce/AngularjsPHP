<div class="container well">
  <form ng-submit="updateInfo()">
    <div class="form-group">
      <label for="Username">User name:</label>
      <input type="text" ng-model="username" ng-disabled="disableEdit" />
    </div>
    <div class="form-group">
      <label for="password">Password:</label>      
      <input type="password" ng-model="password" ng-disabled="disableEdit" />
    </div>
    <div class="form-group">
      <label for="firstname">Firstname:</label>                        
      <input type="text" ng-model="firstname" ng-disabled="disableEdit" />
    </div>
    <div class="form-group">
      <label for="lastname">Lastname:</label>                        
      <input type="text" ng-model="lastname" ng-disabled="disableEdit" />
    </div>
    <div class="form-group">
      <label for="email">Email:</label>            
      <input type="email" ng-model="email" ng-disabled="disableEdit" />
    </div>
    <!--<div class="form-group">
      <label for="phone">Phone:</label>                  
      <input type="text" ng-model="phone" ng-disabled="disableEdit" />
    </div> -->
    <button type="button" ng-show="hideUpdate" ng-click="edit()" class="btn btn-primary">Edit</button>
    <div class="update_cancle" ng-hide="hideUpdate">
      <input type="submit" value="Update" class="btn btn-success"/>
      <button type="button" ng-click="cancleUpdate()" class="btn btn-danger">Cancle</button>
    </div>
  </form>
</div>