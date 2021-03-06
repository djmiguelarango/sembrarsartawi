var header = function ($rootScope, $scope, $http) {

  /**
   * Request create
   * @param  {[type]} event [description]
   */
  $scope.requestCreate = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var href = event.target.href;

    $http.get(href, {

    }).success(function (data, status, headers, config) {
        if (status == 200) {
          $scope.formData.facultative_observation = data.facultative_observation;

          $scope.popup(data.payload);
        }
      }).error(function (err, status, headers, config) {
        console.log(err);
      }).finally(function () {
        $scope.easyLoading('body', '', false);
      });
  };

  /**
   * Request store
   * @param  {[type]} event [description]
   */
  $scope.requestStore = function (event) {
    event.preventDefault();

    if (! $rootScope.submitted) {
      $rootScope.submitted = true;

      $scope.easyLoading('#popup', 'dark', true);

      var action = $scope.getActionAttribute(event);

      CSRF_TOKEN = $scope.csrf_token();

      $http({
        method: 'PUT',
        url: action,
        data: $.param($scope.formData),
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      }).success(function (data, status, headers, config) {
          $scope.errors = {};

          if (status == 200) {
            $scope.success = { facultative: true };
            $scope.redirect(data.location);
          }
        })
        .error(function (err, status, headers, config) {
          $rootScope.submitted = false;

          if (status == 422) {
            $scope.errors = err;
          } else if (status == 500) {
            console.log('Unauthorized action.');
          }
        }).finally(function () {
          $scope.easyLoading('#popup', '', false);
        });
    }
  };

  $('#coverage option:not(:selected), ' +
    '#currency option:not(:selected), ' +
    '#type_term option:not(:selected), ' +
    '#credit_product option:not(:selected), ' +
    '#movement_type option:not(:selected)').prop('disabled', true);

  /*
  Verify Product Mortgage
   */
  $('#_credit_product').change(function () {
    var credit_product = $(this).find(':selected').data('credit-product');

    if (credit_product == 'PMO') {
      bootbox.alert("Esta seguro de continuar con la nueva norma de la APS?", function() {

      });
    }
  });

  /**
   * Create Coverage
   * @param  {[type]} event [description]
   */
  $scope.createCoverage = function (event) {
    event.preventDefault();

    $scope.easyLoading('body', 'dark', true);

    var url = event.target.href;

    $http.get(url, {})
      .then(function (response) {
          if (response.status == 200) {
            var data = response.data;

            $rootScope.data.payment_methods = data.payment_methods;
            $rootScope.data.currencies      = data.currencies;
            $rootScope.data.term_types      = data.term_types;

            $scope.formData.payment_method = $rootScope.data.payment_methods[0];
            $scope.formData.currency       = $rootScope.data.currencies[0];
            $scope.formData.term           = data.term;
            $scope.formData.type_term      = null;

            angular.forEach($rootScope.data.term_types, function(value, key){
              if (value.id === data.type_term) {
                $scope.formData.type_term = value;
              }
            });

            $scope.popup(data.payload);
          }
        }, function(response){
          console.log(response.data);
        }).finally(function () {
          $scope.easyLoading('body', '', false);
        });
  };

  /**
   * [storeCoverage description]
   * @param  {[type]} event [description]
   */
  $scope.storeCoverage = function (event) {
    event.preventDefault();

    if (! $rootScope.submitted) {
      $rootScope.submitted = true;

      $scope.easyLoading('#popup', 'dark', true);

      var action = $scope.getActionAttribute(event);
      CSRF_TOKEN = $scope.csrf_token();

      var data = $.param($scope.formData);

      $http.post(action, data, {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': CSRF_TOKEN
        }
      })
        .then(function (response) {
          $scope.errors = {};

          if (response.status == 200) {
            $scope.success = { coverage: true };
            $scope.redirect(response.data.location);
          }
        }, function (response) {
          $rootScope.submitted = false;

          if (response.status == 422) {
            $scope.errors = response.data;
          } else if (response.status == 500) {
            console.log('Unauthorized action.');
          }
        }).finally(function () {
          $scope.easyLoading('#popup', '', false);
        });
    }
  };

  /*
  Warranty Box Open-Close
   */
  $('.warranty-box').click(function (e) {
    var warranty_box  = $('#warranty-box');
    var warranty_icon = $('#warranty-icon');

    if (warranty_box.is(':hidden')) {
      warranty_icon.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    } else {
      warranty_icon.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    }

    warranty_box.slideToggle();
  });

  /*
  Warranty tooltip
  */
  $('.warranty-box').tooltip();

};

module.exports.header = header;
