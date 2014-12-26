	$(function() {
	    function jump(count) {
	        setTimeout(function() {
	            count--;
	            if (count > 0) {
	                jump(count);
	                $('#num').innerHTML = 2;
	            } else {
	                location.href = "login.jsp";
	            }
	        }, 1000);
	    }
	    jump(3);
	})