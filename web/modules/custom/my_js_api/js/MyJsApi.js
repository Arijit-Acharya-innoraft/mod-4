(function ($, Drupal, once) {
  Drupal.behaviors.myModuleBehavior = {
    attach: function (context, settings) {
      once('myBehavior', 'html').forEach(function (element) {
        var current_user_name = drupalSettings.employee.current_user;  
        // alert(current_user_name);
      })
    
    }
  };
})(jQuery, Drupal, once);