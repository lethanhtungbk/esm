emsApp.directive('emsFileUpload', function(baseURL) {
    return {
        scope: {
            label: '@',
            model: '=',
            options: '=',
            type: '@',
        },
        restrict: 'AE',
        replace: true,
        templateUrl: baseURL + '/template/ems-file-upload.html',
        controller: function($scope)
        {
            $scope.message = [];

            $scope.init = function()
            {
                if ($scope.model == undefined || $scope.model == '')
                {
                    $scope.link = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                }
                else
                {
                    $scope.link = baseURL + '/files/' + $scope.model;
                }
            }

            $scope.callbackHandler = function(e, data)
            {
                console.log(e.type);
                switch (e.type)
                {
                    case 'fileuploadprocessfail':
                        $scope.message.info = data.files[0].error + ". Please try again.";
                        $scope.message.class = "alert-danger";
                        break;

                    case 'fileuploaddone':
                        $scope.model = data.files[0].name;
                        $scope.link = baseURL + '/files/' + $scope.model;
                        $scope.message.info = "Uploaded successfully.";
                        alert($scope.message.info);
                        $scope.message.class = "alert-success";
                        break;

                    case 'fileuploadfail':
                        console.log(data);
                        $scope.message.info = "Upload failed. Please try again.";
                        $scope.message.class = "alert-danger";
                        break;
                }
            };
        }
    };
});

emsApp.directive('fileupload', function(baseURL) {
    return {
        restrict: 'A',
        scope: {
            callback: '&',
            fileType: '@',
        },
        link: function(scope, element, attrs) {
            console.log(scope.fileType);
            var options = {
                url: baseURL + '/restapi/upload',
                dataType: 'json',
                //maxFileSize: 5000000, // 5 MB
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                disableImageResize: /Android(?!.*Chrome)|Opera/
                        .test(window.navigator.userAgent),
                previewMaxWidth: 100,
                previewMaxHeight: 100,
                previewCrop: true,
            };
            
            switch (scope.fileType)
            {
                case "image":
                    options.acceptFileTypes = /(\.|\/)(gif|jpe?g|png)$/i;
                    break;
                    
                case "audio":
                    options.acceptFileTypes = /(\.|\/)(mp3|wav|ogg)/i;
                    break;
                    
                case "video":
                    options.acceptFileTypes = /(\.|\/)(mp4)/i;
                    break;
                    
                case "attachment":
                    options.acceptFileTypes = /(\.|\/)(pdf|doc|docx|xls|xlsx)/i;
                    break;
            }
            
            element.fileupload(options).on([
                'fileuploadadd',
                'fileuploadsubmit',
                'fileuploadsend',
                'fileuploaddone',
                'fileuploadfail',
                'fileuploadalways',
                'fileuploadprogress',
                'fileuploadprogressall',
                'fileuploadstart',
                'fileuploadstop',
                'fileuploadchange',
                'fileuploadpaste',
                'fileuploaddrop',
                'fileuploaddragover',
                'fileuploadchunksend',
                'fileuploadchunkdone',
                'fileuploadchunkfail',
                'fileuploadchunkalways',
                'fileuploadprocessstart',
                'fileuploadprocess',
                'fileuploadprocessdone',
                'fileuploadprocessfail',
                'fileuploadprocessalways',
                'fileuploadprocessstop',
            ].join(' '), function(e, data) {
                scope.$apply(scope.callback({e: e, data: data}));
            });
        }
    }
});