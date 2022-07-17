<li class="dropdown dropdown-notification nav-item noti-container">
    <a class="nav-link nav-link-label noti-bell" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
        <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow noti-count"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
        <li class="dropdown-menu-header">
            <h6 class="dropdown-header m-0">
                <span class="grey darken-2">{{trans('labels.notification')}}</span>
            </h6>
            <span class="notification-tag badge badge-default badge-danger float-right m-0">0 {{trans('labels.new')}}</span>
        </li>
        <li class="scrollable-container media-list w-100">
        </li>
        <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{route('notification.index')}}">{{trans('labels.read_notification')}}</a></li>
    </ul>
</li>

@push('page-js')
    <script type="text/javascript">
        var isLoggedIn = '{{Auth::check()}}';
        if (isLoggedIn == true) {
            var cbNotificationCount = function (response) {
                if (response.data > 0) {
                    $('.noti-bell').find('.noti-count').show();
                    $('.noti-count').text(response.data);
                    $('.notification-tag').text(response.data + ' unread');
                }
            };

            var cbNotificationList = function (response) {
                renderNotificationList(response);
            };

            var getNotificationCountUrl ='{{route('notification.count')}}';
            var getNotificationListUrl = '{{route('notification.latest')}}';

            var notificationCount = function () {
                $.get(getNotificationCountUrl, function (response) {
                    cbNotificationCount(response);
                });
            };

            var interval = 180000; //3 Minutes

            var fetchNotificationList = function () {
                $.get(getNotificationListUrl, function (response) {
                    cbNotificationList(response);
                });
            };

            var renderNotificationList = function (response) {
                var notificationCollection = response.data;
                var notificationContainer = $('.noti-container').find('.scrollable-container');
                notificationContainer.empty();
                if(notificationCollection.length == 0) {
                    notificationContainer.append('<p class="notification-text text-center">' +
                        '<img class="brand-logo" alt="No notification height="50" width="50" available" src="{{ asset('images/Notifications-Off-512.png') }}"/>'+
                        '</p>');
                }
                for (var i in notificationCollection) {
                    var currentNotification = notificationCollection[i];
                    var a = $('<a href="' + currentNotification.item_url + '">');
                    var messageWrapperDiv = $('<div class="media">');
                    var iconWrapperDiv = $('<div class="media-left align-self-center">');
                    var icon = $('<i class="ft-plus-square icon-bg-circle bg-cyan">');
                    iconWrapperDiv.append(icon);
                    messageWrapperDiv.append(iconWrapperDiv);
                    var messageBodyDiv = $('<div class="media-body">');
                    var messageHeader = $('<h6 class="media-heading">');
                    messageHeader.append(currentNotification.type.name);
                    messageBodyDiv.append(messageHeader);
                    var message = $('<p class="notification-text font-small-3 text-muted">');
                    message.append(currentNotification.message);
                    messageBodyDiv.append(message);
                    var messageFooter = $('<small>');
                    var time = $('<time class="media-meta text-muted" datetime="'+currentNotification.created_at+'">');


                    var durationToSubtract = 0;
                    var updatedAt = moment(currentNotification.created_at);
                    var now = moment();
                    updatedAt = updatedAt.add(durationToSubtract, 'hours');
                    var durationSinceLastUpdate = moment.duration(now.diff(updatedAt)).humanize();

                    time.append(durationSinceLastUpdate + ' ago');
                    messageFooter.append(time);
                    messageBodyDiv.append(messageFooter);
                    messageWrapperDiv.append(messageBodyDiv);
                    a.append(messageWrapperDiv);

                    notificationContainer.append(a);
                }
            };

            $(document).ready(function () {
                notificationCount();
                setInterval(notificationCount, interval);

                $('.dropdown-notification').on('click', function (evt) {
                    fetchNotificationList();
                    $('.noti-bell').find('.noti-count').hide();
                });
            });
        }
    </script>
@endpush
