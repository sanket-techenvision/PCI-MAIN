<!DOCTYPE html>
<html>

<head>
    <title>Ready Willing Able Letter (RWA)</title>
    <style>
        body {
            font-family: Verdana, Geneva, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        p {
            margin: 10px 0;
            font-size: small;
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }
        footer {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>REFERENCE NUMBER: [TO BE FILLED BY ISSUIANG BNK]</p>
        <p>ISSUING DATE: [TO BE FILLED BY ISSUING BANK]</p>

        <h4>BENEFICIARY</h4>
        <p>Name: <span style="color: red;">{{ $beneficiary_first_name }} {{ $beneficiary_last_name }}</span></p>
        <p>Address: <span style="color: red;">{{ $beneficiary_address }}, {{ $beneficiary_city }}, {{ $beneficiary_state }}, {{ $beneficiary_country }}</span></p>
        <p>Email: <span style="color: red;">{{ $beneficiary_email }}</span></p>

        <h4>APPLICANT</h4>
        <p>Name: <span style="color: red;">{{ $applicant_first_name }} {{ $applicant_last_name }}</span></p>
        <p>Address: <span style="color: red;">{{ $applicant_address }}, {{ $applicant_city }}, {{ $applicant_state }}, {{ $applicant_country }}</span></p>
        <p>Email: <span style="color: red;">{{ $applicant_email }}</span></p>


        <h3 style="text-decoration: underline; text-align: center; margin-bottom: 20px; ">READY WILLING ABLE LETTER (RWA)</h3>

        <p style="margin-bottom: 20px;">DEAR SIRS,</p>
        <p>WE, <span style="color: red;">{{ $bank_name }}, {{ $bank_address }}</span>, AT THE REQUEST OF OUR CLIENT <span style="color: red;">{{ $applicant_first_name }} {{ $applicant_last_name }}, {{ $applicant_address }}, {{ $applicant_city }}, {{ $applicant_state }}, {{ $applicant_country }}</span></p>
        <p>HEREBY CONFIRM WITH FULL FINANCIAL RESPONSIBILITY THAT WE ARE READY WILLING AND ABLE TO ISSUE A <span style="color: red;">{{ $letter_type }}</span> REFERENCE TO CONTRACT NO. {{$contract_no}} DATED {{$contract_date}} WITH FACE VALUE <span style="color: red;">{{ $guarantee_amount }}</span> IN FAVOUR OF <span style="color: red;">{{ $beneficiary_first_name }} {{ $beneficiary_last_name }} {{ $beneficiary_address }}, {{ $beneficiary_city }}, {{ $beneficiary_state }}, {{ $beneficiary_country }}</span> IN YOUR GOOD BANK, AND IT SHALL BE TRANSMITTED BY SWIFT MT760.</p>

        <p>WE FURTHER CONFIRM THAT THE STANDBY LETTER OF CREDIT IS FREE AND CLEARED OF ENCUMBRANCE AND THE CASH IS GOOD, CLEAN AND CLEAR FUNDS OF NON-CRIMINAL ORIGINS.</p>
        <p>THE AUTHENTICITY AND VALIDITY OF THIS BANK RWA LETTER CAN BE VERIFIED AND CONFIRMED BY BELOW BANK AND TO THE UNDERSIGNED OFFICERS:</p>
        
        <p>BANK: <span style="color: red;">{{$bank_name}}</span></p>
        <p>SWIFT CODE: <span style="color: red;">{{$bank_swift_code}}</span></p>
        <p>TELEPHONE: [ISSUING BANK OFFICER’S TELEPHONE NO] </p>
        <p>EMAIL: [ISSUING BANK OFFICER’S EMAIL]</p>
        <p>NAME OF BANK MANAGER: [BANK OFFICER’S NAME]</p>

        <p>FOR AND ON BEHALF OF</p>
        <p><span style="color: red;">{{$bank_name}}</span></p>
        <p><span style="color: red;">{{$bank_address}}</span></p>
        <footer>
            <p> {{$reference}} </p>
        </footer>
    </div>
</body>

</html>