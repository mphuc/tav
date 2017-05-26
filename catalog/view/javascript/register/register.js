$( document ).ready(function() {
    window.funLazyLoad = {
        start: function() {
            $('.page-loader').show();
        },
        reset: function() {
            $('.page-loader').hide();
        },
        show: function() {
            $('.page-loader').show();
        }
    };
    $('input#phone').keydown(function(event) {
        if (event.keyCode === 13) {
            return true;
        }
        if (!(event.keyCode == 8 || event.keyCode == 46 || (event.keyCode >= 35 && event.keyCode <= 40) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {
            event.preventDefault();
        }
    });

    $('input#cmnd').keydown(function(event) {
        if (event.keyCode === 13) {
            return true;
        }
        if (!(event.keyCode == 8 || event.keyCode == 46 || (event.keyCode >= 35 && event.keyCode <= 40) || (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105))) {
            event.preventDefault();
        }
    });

    $('#agreeTerm').on('change',function(){
        if ($('#agreeTerm').is(":checked"))
       {
        $('#register-account button').removeAttr('disabled');
       }
       else{
        $('#register-account button').attr("disabled","disabled");
       }
       
    }) 

    $('#register-account').on('submit', function(event) {
        window.funLazyLoad.start();
        window.funLazyLoad.show();
        $.fn.existsWithValue = function() {
            return this.length && this.val().length;
        };
        var self = $(this);
        var isValidEmailAddress = function(email, callback) {
            var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
            callback(pattern.test(email));
        };

        var validate = {
            init: function(self) {
                self.find('#username').parent().removeClass('has-error');
                self.find('#user-error').hide();
                 self.find('#BitcoinWalletAddress').parent().removeClass('has-error');
                self.find('#BitcoinWalletAddress-error').hide();
                self.find('#email').parent().removeClass('has-error');
                self.find('#email-error').hide();
                self.find('#phone').parent().removeClass('has-error');
                self.find('#phone-error').hide();
                self.find('#cmnd').parent().removeClass('has-error');
                self.find('#cmnd-error').hide();
                self.find('#country').parent().removeClass('has-error');
                self.find('#country-error').hide();
                self.find('#password').parent().removeClass('has-error');
                self.find('#password-error').hide();
                self.find('#password2').parent().removeClass('has-error');
                self.find('#password2-error').hide();
                self.find('#confirmpassword').parent().removeClass('has-error');
                self.find('#confirmpassword-error').hide();
                self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                self.find('#confirmpasswordtransaction-error').hide();
                $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
            },

            userName: function(self) {
                if (self.find('#username').existsWithValue() === 0) {
                    self.find('#username').parent().addClass('has-error');
                    self.find('#username').focus();
                    self.find('#username').attr('placeholder','Vui lòng nhập tên đăng nhập');
                    /*self.find('#user-error').show();
                    self.find('#user-error span').html('Please enter user name');*/
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },
            BitcoinWalletAddress: function(self) {
                if (self.find('#BitcoinWalletAddress').existsWithValue() === 0) {
                    self.find('#BitcoinWalletAddress').parent().addClass('has-error');
                   self.find('#BitcoinWalletAddress-error span').show();
                    self.find('#BitcoinWalletAddress-error span').html('Please enter your bitcoin wallet!');
                    return false;
                }
                return true;
            },
            email: function(self) {
                if (self.find('#email').existsWithValue() === 0) {
                    self.find('#email').parent().addClass('has-error');
                    self.find('#email').focus();
                    self.find('#email').attr('placeholder','Vui lòng nhập địa chỉ email');
                    /*self.find('#email-error').show();
                    self.find('#email-error span').html('Please enter email address');*/
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },

            phone: function(self) {
                if (self.find('#phone').existsWithValue() === 0) {
                    self.find('#phone').parent().addClass('has-error');
                    self.find('#phone').focus();
                    self.find('#phone').attr('placeholder','Vui lòng nhập địa số điện thoại');
                   
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },

            account_hodder: function(self) {
                if (self.find('#account_hodder').existsWithValue() === 0) {
                    self.find('#account_hodder').parent().addClass('has-error');
                    self.find('#account_hodder').focus();
                    self.find('#account_hodder').attr('placeholder','Vui lòng nhập tên tài khoản ngân hàng');
                   
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },

            account_number: function(self) {
                if (self.find('#account_number').existsWithValue() === 0) {
                    self.find('#account_number').parent().addClass('has-error');
                    self.find('#account_number').focus();
                    self.find('#account_number').attr('placeholder','Vui lòng nhập số tài khoản ngân hàng');
                   
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },

            brank: function(self) {
                if (self.find('#brank').existsWithValue() === 0) {
                    self.find('#brank').parent().addClass('has-error');
                    self.find('#brank').focus();
                    self.find('#brank').attr('placeholder','Vui lòng nhập chi nhánh ngân hàng');
                   
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },

            /*cmnd: function(self) {
                if (self.find('#cmnd').existsWithValue() === 0) {
                    self.find('#cmnd').parent().addClass('has-error');
                    self.find('#cmnd-error').show();
                    self.find('#cmnd-error span').html('The Citizenship card/passport no field is required');
                    return false;
                }
                return true;
            },*/
            country: function(self) {
                if (self.find('#country').existsWithValue() === 0) {
                    self.find('#country').parent().addClass('has-error');
                    self.find('#country').focus();
                
                    /*self.find('#country-error').show();
                    self.find('#country-error span').html('The Citizenship card/passport no field is required');*/
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },
            password: function(self) {
                if (self.find('#password').existsWithValue() === 0) {
                    self.find('#password').parent().addClass('has-error');
                    self.find('#password').focus();
                    self.find('#password').attr('placeholder','Vui lòng nhập mật khẩu');
                    /*self.find('#password-error').show();
                    self.find('#password-error span').html('Please enter password for login');*/
                    window.funLazyLoad.reset();
                    return false;
                }
                return true;
            },
            password_tran: function(self) {
                if (self.find('#password2').existsWithValue() === 0) {
                    self.find('#password2').parent().addClass('has-error');
                    self.find('#password2-error').show();
                    self.find('#password2-error span').html('Please enter transaction password');
                    return false;
                }
                return true;
            },

            repeatPasswd: function(self) {
                if (self.find('#confirmpassword').val() !== self.find('#password').val()) {
                    self.find('#confirmpassword').parent().addClass('has-error');
                    self.find('#confirmpassword-error').show();
                    self.find('#confirmpassword-error span').html('Repeat password for login not correct');
                    return false;
                }
                return true;
            },

            repeatPasswd_tran: function(self) {
                if (self.find('#confirmpasswordtransaction').val() !== self.find('#password2').val()) {
                    self.find('#confirmpasswordtransaction').parent().addClass('has-error');
                    self.find('#confirmpasswordtransaction-error').show();
                    self.find('#confirmpasswordtransaction-error span').html('Repeat Transaction Password is not correct');
                    return false;
                }
                return true;
            },

            checkUserExit: function(self, callback) {
                if (self.find('#username').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#username').data('link'),
                        type: 'GET',
                        data: {
                            'username': self.find('#username').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },

            checkEmailExit: function(self, callback) {
                if (self.find('#email').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#email').data('link'),
                        type: 'GET',
                        data: {
                            'email': self.find('#email').val()
                        },
                        async: false,
                        success: function(result) {

                            result = $.parseJSON(result);
            
                            callback(result.success === 0);
                        }
                    });
                }
            },
            checkPhoneExit: function(self, callback) {
                if (self.find('#phone').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#phone').data('link'),
                        type: 'GET',
                        data: {
                            'phone': self.find('#phone').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },

            /*checkCMND: function(self, callback) {
                if (self.find('#cmnd').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#cmnd').data('link'),
                        type: 'GET',
                        data: {
                            'cmnd': self.find('#cmnd').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.success === 0);
                        }
                    });
                }
            },*/
            check_BitcoinWalletAddress: function(self, callback) {
                if (self.find('#BitcoinWalletAddress').existsWithValue() !== 0) {
                    $.ajax({
                        url: self.find('#BitcoinWalletAddress').data('link'),
                        type: 'GET',
                        data: {
                            'wallet': self.find('#BitcoinWalletAddress').val()
                        },
                        async: false,
                        success: function(result) {
                            result = $.parseJSON(result);
                            callback(result.wallet === 0);
                        }
                    });
                }
            },
        };


        validate.init($(this));
        if (validate.userName($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#username').parent().addClass('has-success');
        }

        if (validate.email($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            var checkEmail = null;
            isValidEmailAddress(self.find('#email').val(), function(callback) {
                checkEmail = !callback ? true : false;
            });
            if (checkEmail) {
                self.find('#email').parent().addClass('has-error');
                self.find('#email-error').show();
                self.find('#email').val('');
                self.find('#email-error span').html('Vui lòng nhập địa chỉ email');
                window.funLazyLoad.reset();
                return false;
            } else {
                validate.init($(this));
                self.find('#email').parent().addClass('has-success');
            }
        }
        if (validate.phone($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#phone').parent().addClass('has-success');
        }
        /*if (validate.cmnd($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#cmnd').parent().addClass('has-success');
        }
        */
        /*if (validate.country($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#country').parent().addClass('has-success');
        }*/

        if (validate.password($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#password').parent().addClass('has-success');
        }


        if (validate.account_hodder($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#account_hodder').parent().addClass('has-success');
        }

        if (validate.account_number($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#account_number').parent().addClass('has-success');
        }

        if (validate.brank($(this)) === false) {
            window.funLazyLoad.reset();
            return false;
        } else {
            validate.init($(this));
            self.find('#brank').parent().addClass('has-success');
        }
        
        /*if (validate.password_tran($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#password2').parent().addClass('has-success');
        }
        
        if (validate.repeatPasswd($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#confirmpassword').parent().addClass('has-success');
        }
        
        if (validate.repeatPasswd_tran($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#confirmpasswordtransaction').parent().addClass('has-success');
        }
         if (validate.BitcoinWalletAddress($(this)) === false) {
            return false;
        } else {
            validate.init($(this));
            self.find('#BitcoinWalletAddress').parent().addClass('has-success');
        }*/
        var checkUser = null;
        var checkEmail = null;
        var checkPhone = null;
        var checkCMND = null;
        var check_BitcoinWalletAddress =null;

        validate.checkUserExit($(this), function(callback) {
            validate.init($(this));
            if (!callback) {
                self.find('#username').parent().addClass('has-error');
                self.find('#user-error').show();
                self.find('#user-error span').html('Tên đăng nhập đã tồn tại');
                self.find('#username').val('');
                self.find('#username').parent().removeClass('has-success');
                self.find('#username').parent().addClass('has-error');
                self.find('#username').attr('placeholder','Tên đăng nhập đã tồn tại');
                $('#username').css({'border':'1px solid red'});

                self.find('#password').val('');
                self.find('#password').parent().removeClass('has-success');
                self.find('#confirmpassword').val('');
                self.find('#confirmpassword').parent().removeClass('has-success');
                // self.find('#password2').val('');
                self.find('#password2').parent().removeClass('has-success');
                // self.find('#confirmpasswordtransaction').val('');
                self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                return false;
            } else {
                self.find('#username').parent().removeClass('has-error');
                self.find('#user-error').hide();
                self.find('#email').parent().removeClass('has-error');
                self.find('#email-error').hide();
                self.find('#phone').parent().removeClass('has-error');
                self.find('#phone-error').hide();
                self.find('#cmnd').parent().removeClass('has-error');
                self.find('#cmnd-error').hide();
                self.find('#BitcoinWalletAddress').parent().removeClass('has-error');
                self.find('#BitcoinWalletAddress-error').hide();
                self.find('#country').parent().removeClass('has-error');
                self.find('#country-error').hide();
                self.find('#password').parent().removeClass('has-error');
                self.find('#password-error').hide();
                self.find('#password2').parent().removeClass('has-error');
                self.find('#password2-error').hide();
                self.find('#confirmpassword').parent().removeClass('has-error');
                self.find('#confirmpassword-error').hide();
                self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                self.find('#confirmpasswordtransaction-error').hide();
                $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                self.find('#username').parent().addClass('has-success');
                checkUser = true;
            }
        });
        //checkUser = true;
        if (checkUser) {
            validate.checkEmailExit($(this), function(callback) {
                if (!callback) {
                    self.find('#email').parent().addClass('has-error');
                    self.find('#email').val('');
                    self.find('#email').focus();
                    self.find('#email').attr('placeholder','This email is already exists');
                    //self.find('#email-error').show();
                    /*self.find('#email-error span').html('This email is already exists');*/
                    self.find('#password').val('');
                    /*self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');*/
                    // self.find('#password2').val('');
                    //self.find('#password2').parent().removeClass('has-success');
                    // self.find('#confirmpasswordtransaction').val('');
                    //self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    window.funLazyLoad.reset();
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#BitcoinWalletAddress').parent().removeClass('has-error');
                    self.find('#BitcoinWalletAddress-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#email').parent().addClass('has-success');
                    checkEmail = true;
                }
            });
        };

        if (checkUser && checkEmail) {
            validate.checkPhoneExit($(this), function(callback) {
                if (!callback) {
                    self.find('#phone').parent().addClass('has-error');

                    self.find('#phone').val('');
                    self.find('#phone').focus();
                    self.find('#phone').attr('placeholder','This phone is already exists');

                    /*self.find('#phone-error').show();
                    self.find('#phone-error span').html('This phone is already exists');*/
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    /*self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');*/
                    // self.find('#password2').val('');
                    //self.find('#password2').parent().removeClass('has-success');
                    // self.find('#confirmpasswordtransaction').val('');
                    //self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    window.funLazyLoad.reset();
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#BitcoinWalletAddress').parent().removeClass('has-error');
                    self.find('#BitcoinWalletAddress-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#phone').parent().addClass('has-success');
                    checkPhone = true;
                }
            });
        };
        /*if (checkUser && checkEmail && checkPhone) {
            validate.checkCMND($(this), function(callback) {
                if (!callback) {
                    self.find('#cmnd').parent().addClass('has-error');
                    self.find('#cmnd-error').show();
                    self.find('#cmnd-error span').html('This citizenship card/passport no is already exists');
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');
                    // self.find('#password2').val('');
                    self.find('#password2').parent().removeClass('has-success');
                    // self.find('#confirmpasswordtransaction').val('');
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#cmnd').parent().addClass('has-success');
                    checkCMND = true;
                }
            });
        }*/
        /*if (checkUser && checkEmail && checkPhone) {
            validate.check_BitcoinWalletAddress($(this), function(callback) {
                if (!callback) {
                    self.find('#BitcoinWalletAddress').parent().addClass('has-error');
                    self.find('#BitcoinWalletAddress-error').show();
                    self.find('#BitcoinWalletAddress-error span').html('Wrong bitcoin wallet address!!');
                    self.find('#password').val('');
                    self.find('#password').parent().removeClass('has-success');
                    self.find('#confirmpassword').val('');
                    self.find('#confirmpassword').parent().removeClass('has-success');
                    // self.find('#password2').val('');
                    self.find('#password2').parent().removeClass('has-success');
                    // self.find('#confirmpasswordtransaction').val('');
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-success');
                    return false;
                } else {
                    self.find('#username').parent().removeClass('has-error');
                    self.find('#user-error').hide();
                    self.find('#email').parent().removeClass('has-error');
                    self.find('#email-error').hide();
                    self.find('#phone').parent().removeClass('has-error');
                    self.find('#phone-error').hide();
                    self.find('#cmnd').parent().removeClass('has-error');
                    self.find('#cmnd-error').hide();
                    self.find('#BitcoinWalletAddress').parent().removeClass('has-error');
                    self.find('#BitcoinWalletAddress-error').hide();
                    self.find('#country').parent().removeClass('has-error');
                    self.find('#country-error').hide();
                    self.find('#password').parent().removeClass('has-error');
                    self.find('#password-error').hide();
                    self.find('#password2').parent().removeClass('has-error');
                    self.find('#password2-error').hide();
                    self.find('#confirmpassword').parent().removeClass('has-error');
                    self.find('#confirmpassword-error').hide();
                    self.find('#confirmpasswordtransaction').parent().removeClass('has-error');
                    self.find('#confirmpasswordtransaction-error').hide();
                    $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
                    self.find('#BitcoinWalletAddress').parent().addClass('has-success');
                    check_BitcoinWalletAddress = true;
                }
            });
        }*/
        /*if (!self.find('#agreeTerm').is(":checked")) {
            self.find('#agreeTerm').addClass('validation-error');
            self.find('#agreeTerm').focus();
            window.funLazyLoad.reset();
            return false;
        } else {
            $('#agreeTerm').is(":checked") && $('#agreeTerm').removeClass('validation-error');
        }*/

        
        if(checkEmail && checkPhone){

            window.funLazyLoad.start();
            $('.btn-register').hide();
            return true;
        }

        return false;

    });
});

function goBack() {
    window.history.back();
}