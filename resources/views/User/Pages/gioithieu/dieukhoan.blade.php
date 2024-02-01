@extends('User.main')

@section('content')
    <style>
        a{
            color: #078b8f;
        }
    </style>
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Điều khoản & dịch vụ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
    <div class="container mw-50 mt-10 mb-10 p-3 align-items-center align-content-center">
        <div class="large-12 col">
            <div class="col-inner">
                <h1><strong>Điều khoản sử dụng &amp; Chính sách quyền riêng tư</strong></h1>
                <p style="text-align: justify;">Tại Website Đại Dương, chúng tôi cam kết tôn trọng và bảo vệ quyền riêng tư của tất cả những người sử dụng dịch vụ của chúng tôi.
                    Đó là lý do tại sao chúng tôi phát triển Điều khoản sử dụng và Chính sách quyền riêng tư này.</p>
                <p style="text-align: justify;">Điều khoản sử dụng và Chính sách quyền riêng tư sau đây giải thích các cách khác nhau mà chúng tôi thu thập thông tin và dữ liệu cá nhân về người dùng của mình, giải thích thời điểm và lý do chúng tôi sẽ chia sẻ dữ liệu cá nhân cũng như nêu chi tiết các quyền và lựa chọn mà bạn sở hữu đối với đến dữ liệu cá nhân của mình.
                    Bằng cách sử dụng website Đại Dương, bạn đã xác nhận rằng bạn đồng ý với các điều khoản của chính sách này.</p>
                <p style="text-align: justify;">Website của chúng tôi có thể chứa các liên kết đến các trang web khác do các tổ chức khác điều hành có điều khoản sử dụng và chính sách quyền riêng tư của riêng họ. Vui lòng đảm bảo bạn đọc kỹ các điều khoản, điều kiện và chính sách quyền riêng tư trước khi cung cấp bất kỳ dữ liệu cá nhân nào trên trang web vì chúng tôi không chấp nhận bất kỳ trách nhiệm hoặc nghĩa vụ pháp lý nào đối với trang web của các tổ chức khác.</p>
                <p style="text-align: justify;">Đôi khi, chính sách này có thể thay đổi nên bạn sẽ muốn kiểm tra để đảm bảo rằng bạn hài lòng với những thay đổi của chúng tôi. Các câu hỏi về chính sách này hoặc các vấn đề khác liên quan đến quyền riêng tư có thể được gửi tới <a href="mailto:cskh@daiduong.com">cskh@daiduong.com</a>. Số điện thoại liên hệ của chúng tôi là <a href="tel:+84869622389">+84 (0)869 622 389</a>.</p>
                <h2><strong>Dữ liệu cá nhân chúng tôi thu thập</strong></h2>
                <p style="text-align: justify;">Khi bạn đăng ký Ứng dụng di động của chúng tôi, bạn có thể cung cấp cho chúng tôi:</p>
                <ul>
                    <li>Thông tin cá nhân của bạn, bao gồm tên, địa chỉ, email, số điện thoại và ngày sinh.</li>
                    <li>Chi tiết đăng nhập tài khoản của bạn, như tên người dùng và mật khẩu bạn đã chọn.</li>
                </ul>
                <p style="text-align: justify;">Khi bạn sử dụng Ứng dụng di động của chúng tôi, chúng tôi có thể thu thập thông tin về:</p>
                <ul>
                    <li>Các thiết bị bạn đã sử dụng để truy cập Ứng dụng di động của chúng tôi (bao gồm địa chỉ IP, loại trình duyệt và số nhận dạng thiết bị di động)</li>
                    <li>Hành vi trực tuyến của bạn</li>
                </ul>
                <h2><strong>Thông tin của bạn được sử dụng như thế nào?</strong></h2>
                <p style="text-align: justify;">Chúng tôi có thể sử dụng thông tin cá nhân của bạn để:</p>
                <ul>
                    <li>Thông báo cho bạn về những thay đổi quan trọng đối với Dịch vụ và Chính sách của chúng tôi</li>
                    <li>Gửi cho bạn thông tin về Sản phẩm và Dịch vụ mà bạn có thể quan tâm từ chúng tôi hoặc các đối tác của chúng tôi</li>
                    <li>Thực hiện nghĩa vụ hợp đồng của chúng tôi</li>
                    <li>Cho phép truy cập vào các Trang web hoặc Dịch vụ ứng dụng di động cụ thể</li>
                    <li>Cải thiện Sản phẩm và Dịch vụ mà chúng tôi cung cấp và mang lại trải nghiệm tốt hơn trên Ứng dụng di động Aguri Fitness</li>
                    <li>Giao tiếp tốt hơn với bạn</li>
                </ul>
                <p style="text-align: justify;">Khoảng thời gian chúng tôi lưu giữ thông tin cá nhân được xem xét thường xuyên. Thông tin cá nhân được lưu giữ an toàn trên hệ thống của chúng tôi trong khoảng thời gian cần thiết cho các hoạt động liên quan.</p>
                <h2><strong>Chia sẻ dữ liệu cá nhân với các tổ chức khác</strong></h2>
                <p style="text-align: justify;">Chúng tôi chỉ có thể chia sẻ dữ liệu cá nhân với các tổ chức khác trong các trường hợp sau:</p>
                <ul>
                    <li>Nếu luật pháp hoặc cơ quan công quyền yêu cầu;</li>
                    <li>Nếu chúng tôi cần chia sẻ dữ liệu cá nhân để thiết lập, thực hiện hoặc bảo vệ các quyền hợp pháp của mình;</li>
                    <li>Cho tổ chức mà chúng tôi bán hoặc chuyển nhượng (hoặc tham gia đàm phán để bán hoặc chuyển nhượng) bất kỳ hoạt động kinh doanh nào của chúng tôi. Nếu việc chuyển nhượng hoặc bán được tiến hành, tổ chức nhận dữ liệu cá nhân của bạn có thể sử dụng dữ liệu cá nhân của bạn theo cách giống như chúng tôi.</li>
                    <li>Thông tin của bạn không bao giờ được chia sẻ với bên thứ ba vì mục đích tiếp thị mà không có sự đồng ý của bạn.</li>
                </ul>
                <h2><strong>Bảo vệ dữ liệu cá nhân</strong></h2>
                <p style="text-align: justify;">Chúng tôi sử dụng các biện pháp bảo vệ máy chủ như tường lửa, sao lưu dữ liệu thường xuyên, mã hóa dữ liệu và chính sách bảo vệ mật khẩu an toàn trên tất cả các hệ thống xử lý thông tin cá nhân của bạn. Chúng tôi thực thi các biện pháp kiểm soát quyền truy cập vật lý vào các tòa nhà và tệp để giữ an toàn cho dữ liệu.</p>
                <p style="text-align: justify;">Mặc dù chúng tôi thực hiện các biện pháp kỹ thuật và tổ chức phù hợp để bảo vệ dữ liệu cá nhân của bạn, chúng tôi không thể đảm bảo tính bảo mật của bất kỳ dữ liệu cá nhân nào mà bạn chuyển qua internet cho chúng tôi.</p>
                <h2><strong>Quyền lợi của bạn</strong></h2>
                <p style="text-align: justify;">Bạn có quyền xem dữ liệu cá nhân mà chúng tôi lưu giữ về bạn. Mọi yêu cầu phải được thực hiện bằng văn bản và chúng tôi sẽ trả lời trong vòng một tuần. Chúng tôi không tính phí cho dịch vụ này.</p>
                <p style="text-align: justify;">Nếu bạn muốn có bản sao dữ liệu cá nhân mà chúng tôi lưu giữ về bạn, vui lòng gửi email cho chúng tôi theo địa chỉ <a href="mailto:cskh@daiduong.com">cskh@daiduong.com</a></p>
                <p style="text-align: justify;">Chúng tôi muốn đảm bảo rằng dữ liệu cá nhân mà chúng tôi lưu giữ về bạn là chính xác và cập nhật. Nếu bất kỳ chi tiết nào không chính xác, vui lòng cho chúng tôi biết và chúng tôi sẽ sửa đổi chúng.</p>
                <p style="text-align: justify;">&nbsp;</p>


            </div>
        </div>
    </div>
@endsection
