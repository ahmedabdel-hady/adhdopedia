
    
    // calculator custom functions
            var oper = "";
            var num = "";

            function displaynum(n) {
                //document.form1.t1.value = document.form1.t1.value + n;
                $("#display").val( $("#display").val() + n );

            }

            function operator(op) {
                oper = op;
                num = $("#display").val();
                $("#display").val("");
                //document.form1.t1.value += oper
            }
            //code for equals starts here
            function equals() {
            doesthejob(eval(num), eval($("#display").val()), oper);
            }
            //a sub-function of equals 
            function doesthejob(n1, n2, op) {
                if (op == "+")
                    $("#display").val( n1 + n2 );
                else if (op == "-")
                    $("#display").val( n1 - n2 );
                else if (op == "*")
                    $("#display").val( n1 * n2 );
                else if (op == "/")
                    $("#display").val( n1 / n2 );
                else if (op == "nCr")
                    document.form1.t1.value = fact2(n1) / fact2(n1 - n2) / fact2(n2);
                else if (op == "nPr")
                    document.form1.t1.value = fact2(n1) / fact2(n1 - n2);
            }
            //code for equals ends here

            function fact2(n) {    // fact2() for nCr & nPr
            if (errorchecking(n) == false)
                    return;

                    var answer = 1;
                    for (i = n; i >= 2; i--){
            answer = answer * i;
            }
            return answer;
            }

            function fact() {
            n = Number(document.form1.t1.value);
                    if (errorchecking(n) == false)
                    return;
                    var answer = 1;
                    for (i = n; i >= 2; i--){
            answer = answer * i;
            }
            document.form1.t1.value = answer;
            }

            function errorchecking(n) {
                if (n < 0) {
                    alert("Number shouldn't be negative");
                    return false;
                }
                var mod = n % 1;
                if (!mod == 0) {
                    alert("The number should be an integer");
                    return false;
                }
            }

            function prime(n) {
            if (errorchecking(n) == false)
                    return;
                    var b = true;
                    for (i = 2; i <= n / 2; i ++) {
            if (n % i == 0) {
            document.form1.t1.value = "Not prime; its first divided by " + i;
                    b = false;
                    break;
            }
            }
            if (b)
                    document.form1.t1.value = "Is prime";
            }

            function negation() {
            document.form1.t1.value = document.form1.t1.value * - 1;
            }

            function reset() {
                $("#display").val("");
                    num = "";
            }
            // Calculator functions end here.