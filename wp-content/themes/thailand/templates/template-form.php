   <div class="form-area">
       <?php
        // chen captcha va tao session['captcha'] moi
        require DIR_CLASSES . 'captcha/CaptchaCls.php';
        $checkCode = new CaptchaCls(5, true);
        ?>

       <form id="f_contact" name="f_contact" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
           <div class="form-contact">
               <div class="form-row">
                   <div class="form-text">Company <i class="error-style" id="error-company"></i></div>
                   <div class="form-input">
                       <input type="text" name="txt-company" id="txt-company" class="form-control my-input" />
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-text">Name <i class="error-style" id="error-name"></i></div>
                   <div class="form-input">
                       <input type="text" name="txt-name" id="txt-name" class="form-control my-input" />
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-text">E-mail <i class="error-style" id="error-email"></i></div>
                   <div class="form-input">
                       <input type="text" name="txt-email" id="txt-email" class="form-control my-input type-email" />
                   </div>
               </div>
               <div class="form-row">
                   <div class="form-text">Phone <i class="error-style" id="error-phone"></i></div>
                   <div class="form-input">
                       <input type="text" name="txt-phone" id="txt-phone" class="form-control my-input type-phone" />
                   </div>
               </div>
               <div class="form-row captcha-row">
                   <div class="error-style" id="error-captcha">
                       <?php if ($checkCode == "wrong" && $arr != "") { ?>
                           Captcha Code No Match
                       <?php } ?>
                   </div>
                   <div class="form-input">
                       <div class="captcha-area">
                           <img src="<?php echo get_template_directory_uri(); ?>/classes/captcha/captcha.php"
                               id="captcha-img"
                               alt="captcha"
                               title="Click to refresh"
                               style="cursor: pointer" ; />

                           <input name="txt-captcha" id="txt-captcha" type="text"
                               class="captcha-input my-input"
                               maxlength="5"
                               placeholder="enter captcha code" />


                       </div>
                   </div>
               </div>
               <div class="form-row" style="margin-top: 13px;">
                   <div class="form-text">
                       นโยบายความเป็นส่วนตัว
                   </div>
                   <div class="form-input check-row">
                       <input type="checkbox" name="chk-box" id="chk-box" class="form-check-input" />
                       <label>ฉันยอมรับข้อตกลงความเป็นส่วนตัวของ บริษัทดิจิวิน ซอฟต์แวร์ (ประเทศไทย) จำกัด</label>
                   </div>
               </div>
           </div>
           <div id='form-response'></div>
           <div class="btn-row">
               <input type="hidden" name="action" value="my_ajax_form_submit">
               <input type="reset" id="btn-reset" name="btn-reset" value="Reset" class="my-btn" />
               <input type="button" id="btn-submit" name="btn-submit" value="Submit" class="my-btn" />
           </div>
       </form>
   </div>
   <script>
       jQuery(window).on('load', function() {

           let sessionCaptcha = '<?php echo $_SESSION['captcha'] ?? ''; ?>';
           const baseUrl = '<?php echo get_template_directory_uri(); ?>/classes/captcha/captcha.php';

           // 🔄 點擊刷新圖片
           jQuery('#captcha-img').on('click', function() {
               jQuery(this).attr('src', baseUrl + '?reset=true&' + Math.random());

               // 等圖片生成後再抓新的 session captcha
               setTimeout(() => {
                   jQuery.get(baseUrl + '?getCode=true', function(data) {
                       sessionCaptcha = data.trim();
                       // console.log('新 Captcha:', sessionCaptcha);
                   });
               }, 300);
           });

           jQuery('#btn-submit').on('click', function(e) {
               e.preventDefault();

               const fields = [{
                       id: '#txt-company',
                       error: '#error-company'
                   },
                   {
                       id: '#txt-name',
                       error: '#error-name'
                   },
                   {
                       id: '#txt-email',
                       error: '#error-email'
                   },
                   {
                       id: '#txt-phone',
                       error: '#error-phone'
                   },
                   {
                       id: '#txt-captcha',
                       error: '#error-captcha'
                   } // Captcha 這裡
               ];

               let isValid = true;

               fields.forEach(field => {
                   const $input = jQuery(field.id);
                   const $error = jQuery(field.error);

                   if ($input.length === 0) {
                       console.warn(field.id + ' not found in DOM');
                       return;
                   }

                   const value = String($input.val() || '').trim();

                   if (value === '') {
                       $error.text('Cannot be empty');
                       isValid = false;
                   } else {
                       $error.text('');
                   }
               });

               //====================================
               let captcha = jQuery('#txt-captcha').val().trim();

               if (captcha != sessionCaptcha && captcha != '') {
                   jQuery('#error-captcha').text('Captcha Incorrect!');
                   isValid = false;
               }
               // het loi ====================================================================================
               if (isValid) {

                   // 2. 獲取所有表單數據，並加上正確的 action 參數
                   var formData = jQuery('#f_contact').serialize();
                   formData += '&action=my_form_action'; // 確保 action 參數正確附加，與 PHP hook 對應

                   // 3. 顯示發送中訊息
                   jQuery('body').css('overflow', 'hidden');
                   jQuery('#form-response').css({
                       'display': 'flex'
                   }).html('<p>Sending...</p>');

                   jQuery.ajax({
                       // 使用 admin-ajax.php
                       url: '<?php echo admin_url("admin-ajax.php"); ?>',
                       type: 'POST',
                       data: formData, // 直接發送包含所有表單欄位和 action 的數據
                       dataType: 'json', // 預期伺服器返回 JSON 格式

                       success: function(response) {
                           // response 應該是 JSON 格式: {success: true/false, data: ...}
                           if (response.success) {
                               jQuery('body').css('overflow', 'hidden');
                               jQuery('#form-response').css({
                                   'display': 'flex'
                               }).html('<p>Thank you for your message!<br><br>We will contact you soon.</p>');

                               jQuery('#f_contact')[0].reset(); // 清空表單
                               // 刷新 Captcha
                               jQuery('#captcha-img').click();

                               // 2. ĐẶT HẸN GIỜ (3 GIÂY = 3000 MILI GIÂY)
                               setTimeout(function() {
                                   // 3. ẨN LỚP PHỦ & MỞ LẠI CUỘN SAU 3 GIÂY
                                   // Ẩn div #form-response
                                   jQuery('#form-response').css('display', 'none').empty();
                                   // Khôi phục thanh cuộn trên thẻ body
                                   jQuery('body').css('overflow', 'auto');
                                   // Tùy chọn: Xóa nội dung trong div sau khi ẩn (để dọn dẹp)
                                //    jQuery('#form-response').empty();

                               }, 3000); // 3000 miligiây = 3 giây

                           } else {
                               var message = response.data && response.data.message ? response.data.message : 'Submission failed. Please try again.';
                               jQuery('body').css('overflow', 'hidden');
                               jQuery('#form-response').css({
                                   'display': 'flex'
                               }).html('<p style="color:red;">' + message + '</p>');
                               // 刷新 Captcha (通常在失敗時也需要刷新)
                               jQuery('#captcha-img').click();
                               // 2. ĐẶT HẸN GIỜ (3 GIÂY = 3000 MILI GIÂY)
                               setTimeout(function() {
                                   // 3. ẨN LỚP PHỦ & MỞ LẠI CUỘN SAU 3 GIÂY
                                   // Ẩn div #form-response
                                   jQuery('#form-response').css('display', 'none').empty();

                                   // Khôi phục thanh cuộn trên thẻ body
                                   jQuery('body').css('overflow', 'auto');


                               }, 3000); // 3000 miligiây = 3 giây
                           }
                       },
                       error: function(xhr, status, error) {
                           console.error(xhr.responseText);
                           jQuery('#form-response').html('<p style="color:red;">An error occurred during submission. Please check the console.</p>');
                           // 刷新 Captcha
                           jQuery('#captcha-img').click();
                           setTimeout(function() {
                               jQuery('#form-response').css('display', 'none').empty();
                               // Khôi phục thanh cuộn trên thẻ body
                               jQuery('body').css('overflow', 'auto');
                           }, 5000); // 3000 miligiây = 3 giây
                       }
                   });
               };
           });

       })

       // === 頁面初始也先綁定一次 ===
       var imgLocal = '<?php echo PART_IMAGES . 'social/location.png'; ?>';
       jQuery('.local').css('--bg', 'url("' + imgLocal + '")');

       var imgEmail = '<?php echo PART_IMAGES . 'social/email.png'; ?>';
       jQuery('.email').css('--bg', 'url("' + imgEmail + '")');

       var imgPhone = '<?php echo PART_IMAGES . 'social/smartphone.png'; ?>';
       jQuery('.phone').css('--bg', 'url("' + imgPhone + '")');
   </script>