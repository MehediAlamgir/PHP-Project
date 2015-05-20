        function checkEmail()
        {
            var email = document.getElementById("email").value;
            var atpos=email.indexOf("@");
            var dotpos=email.lastIndexOf(".");
            if (email.trim() == "") {
                window.alert("missing e-mail address !!!");
                return false;
            }
            else if (atpos<1 || dotpos<atpos+2 || dotpos+1 >=email.length)
            {
                window.alert("Invalid e-mail address");
                return false;
            }
            /*var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(email.value)) {
                alert('Please provide a valid email address');
                email.focus;
                return false;
            }*/
            return true;
        }
        
        function checkPhone()
        {
            var phone = document.getElementById("phone").value;
            var tmp = phone.substring(0 , 2);
            var len = phone.length;
            var tof = false;
            var cnt = 0 ;
            if (len == 11) {
                for (var i = 0 ; i < len ; i++) {
                    tof = false;
                    for (var j = 0 ; j <= 9  ; j++) {
                        if (phone[i] == j) {
                            tof = true;
                            cnt++;
                            break;
                        }
                    }
                    if (tof == false) {
                        break;
                    }
                }
            }
            
            if (phone.trim() == "") {
                window.alert("missing phone number !!!");
                return false;
            }
            else if (tmp != "01"  || cnt!=11 || len != 11) {
                window.alert("invalid phone number !!!");
                return false;
            }
            return true;
            
        }
        
        function checkName()
        {
            var name = document.getElementById("name").value;
            if (name.trim() == "") {
                window.alert("Missing Name !!!!");
                //fname.focus();
                return false;
            }
            return true;
        }
        
        function checkPassword()
        {
            var pass  = document.getElementById("pass").value;
            var repass  = document.getElementById("repass").value;
            var len = pass.length;
            var isValid = false;
            for (var i = 0 ; i < len ; i++) {
                
                if (pass[i] == "!"){
                    isValid = true;
                    break;
                }
                else if (pass[i] == "@") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "#") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "$") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "%") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "^") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "&") {
                    isValid = true;
                    break;
                }
                else if (pass[i] == "*") {
                    isValid = true;
                    break;
                }
            }
            
            if (pass.trim() == "")
            {
                window.alert("missing password !!!!");
                return false;
            }
            else if (len < 6) {
                window.alert("password must contain at least 6 characters !!!");
                return false;
            }
            else if (isValid==false )
            {
                window.alert("password must contain at least one [ ! , @ , # , $ , % , ^ , & , * ] character !");
                return false;
            }
            else if (pass != repass ) {
                window.alert("password mismatched !!!");
                return false;
            }
           
            return true;
        }
        
        function validate() {
            if (checkName() == false )
            {
                return false;
            }
            if (checkEmail() == false) {
                return false;
            }
            if (checkPhone() == false) {
                return false;
            }
            
            if (checkPassword() == false) {
                return false;
            }
            return true;
        }
        
        function loginCheck() {
            var email = document.getElementById("login_email").value;
            var pass = document.getElementById("login_pass").value;
            if (email.trim() == "" || pass.trim() == "") {
                window.alert("Missing E-mail or Password!");
                return false;
            }
            return true;
        }
        
        function plane_info() {
            var plane_name = document.getElementById("plane_name").value;
            var f = document.getElementById("first_class_seats").value;
            var e = document.getElementById("economy_class_seats").value;
            var ex = document.getElementById("executive_class_seats").value;
            
            if (plane_name.trim().length == 0) {
                alert('Missing Plane Name!!!');
                return false;
            }
            if (f.trim().length > 2  || e.trim().length > 2 || ex.trim().length > 2) {
                alert('you must provide number of seats of your plane !!!!');
                return false;
            }
            return true;
            
        }
        

 
 