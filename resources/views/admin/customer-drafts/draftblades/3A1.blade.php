<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MT760 Guarantee / Performance Bank Guarantee</title>
    <style>
        *{
            text-transform: uppercase;
        }
        body {
            font-family: 'Century Gothic', sans-serif;
            line-height: 1;
        }

        p {
            margin: 10px 0;
            font-size: 12px;
            text-align: justify;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: none;
            font-size: 12px;
        }

        th,
        td {
            padding: 3px;
            text-align: left;
            font-size: 12px;
            font-size: 12px;
        }

        .dynamic-field {
            color: red;
        }
    </style>
</head>

<body>
    <p class="dynamic-field">DRAFT MT760</p>
    <p>SWIFT INPUT: MT760 GUARANTEE / PERFORMANCE BANK GUARANTEE</p>
    <p>SENDER: <span class="dynamic-field">[TO BE FILLED BY ISSUING BANK]</span></p>
    <p>RECEIVER: <span class="dynamic-field">{{ $advising_swift_code }}</span></p>
    <p>...</p>
    <table>
        <tr>
            <td>15A:</td>
            <td>NEW SEQUENCE</td>
        </tr>
        <tr>
            <td>27:</td>
            <td>SEQUENCE OF TOTAL</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>1/1</td>
        </tr>
        <tr>
            <td>22A:</td>
            <td>PURPOSE OF MESSAGE</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>ISSUE</td>
        </tr>
        <tr>
            <td>72Z:</td>
            <td>SENDER TO RECEIVER INFORMATION</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>PLEASE APPRISE US WITH DATE OF ADVISING TO THE BENEFICIARY</td>
        </tr>
        <tr>
            <td>15B:</td>
            <td>NEW SEQUENCE</td>
        </tr>
        <tr>
            <td>20:</td>
            <td>UNDERTAKING NUMBER</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="dynamic-field">[TO BE FILLED BY ISSUING BANK]</td>
        </tr>
        <tr>
            <td>30:</td>
            <td>DATE OF ISSUE</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="dynamic-field">[TO BE FILLED BY ISSUING BANK]</td>
        </tr>
        <tr>
            <td>22D:</td>
            <td>FORM OF UNDERTAKING</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>DGAR</td>
        </tr>
        <tr>
            <td>40C:</td>
            <td>APPLICABLE RULES</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>URDG</td>
        </tr>
        <tr>
            <td>23B:</td>
            <td>EXPIRY TYPE</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>FIXD</td>
        </tr>
        <tr>
            <td>31E:</td>
            <td>DATE OF EXPIRY</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>2302XX (<span class="dynamic-field">$number_of_days</span> DAYS AFTER ISSUANCE DATE)</td>
        </tr>
        <tr>
            <td>50:</td>
            <td>APPLICANT</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="dynamic-field">{{ $applicant_first_name }} {{ $applicant_last_name }}<br>{{ $applicant_address }}, {{ $applicant_country }}, {{ $applicant_state }}, {{ $applicant_city }}</td>
        </tr>
        <tr>
            <td>52D:</td>
            <td>ISSUER</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="dynamic-field">{{ $bank_name }}<br>{{ $bank_address }}<br>SWIFT/BIC: {{ $bank_swift_code }}</td>
        </tr>
        <tr>
            <td>59:</td>
            <td>BENEFICIARY</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>A/C NUMBER <span class="dynamic-field">{{ $beneficiary_account_no }}<br>{{ $beneficiary_company_name }}<br>{{ $beneficiary_address }}</span></td>
        </tr>
        <tr>
            <td>56D:</td>
            <td>ADVISING BANK</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td class="dynamic-field">{{ $advising_swift_code }}<br>{{ $beneficiary_bank_name }}<br>{{ $beneficiary_bank_address }}</td>
        </tr>
        <tr>
            <td>32B:</td>
            <td>UNDERTAKING AMOUNT</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>CURRENCY: <span class="dynamic-field">{{ $currency_code }}</span><br>AMOUNT: <span class="dynamic-field">{{ $guarantee_amount }} ({{ $amount_in_words }} ONLY)</span></td>
        </tr>
    </table>

    <p>71D: ADDITIONAL AMOUNT INFORMATION</p>
    <p>ANY CONFIRMATION OR ADVISING CHARGES OUTSIDE ISSUER ARE FOR THE BENEFICIARY ACCOUNT AND MAY
        NOT BE WAIVED</p>
    <p>77U: UNDERTAKING TERMS AND CONDITIONS</p>
    <p>DEAR SIRS,</p>
    <p>SUBJECT: PERFORMANCE BOND GUARANTEE FOR PROJECT <span class="dynamic-field">{{ $project_name }}.</span></p>
    <p>AT THE REQUEST OF <span class="dynamic-field">{{ $applicant_first_name }} {{ $applicant_last_name }}</span> (“APPLICANT”) WE, <span class="dynamic-field">{{ $bank_name}} {{ $bank_address }},</span> HEREBY
        UNDERTAKE TO GUARANTEE YOU THE PAYMENT OF <span class="dynamic-field">{{ $currency_code }} - {{ $guarantee_amount }} </span>(‘GUARANTEED AMOUNT”) AS A
        PERFORMANCE BOND IN RESPECT OF APPLICANT’S OBLIGATIONS UNDER THE ABOVE SUBJECT PROJECT
        (“CONTRACT”)</p>
    <p>OUR LIABILITY UNDER THIS GUARANTEE SHALL NOT IN ANY CIRCUMSTANCES EXCEED THE GUARANTEED AMOUNT.</p>
    <p>THIS GUARANTEE IS VALID UP TO <span class="dynamic-field">[TO BE FILLED BY ISSUING BANK] – $number_of_days</span> DAYS AFTER ISSUANCE DATE
        (“EXPIRY DATE”).</p>
    <p>ANY CLAIM UNDER THIS GUARANTEE MUST BE SUBMITTED TO US IN WRITING, DULY SIGNED BY BENEFICIARY (WHICH
        SIGNATURES SHOULD BE VERIFIED BY YOUR BANKER) CONFIRMING THAT THE APPLICANT HAS FAILED TO PERFORM
        ITS OBLIGATIONS UNDER THE CONTRACT TOGETHER WITH THE ORIGINAL OF THIS GUARANTEE AND AMENDMENTS
        (IF ANY). WE UNDERTAKE TO PAY YOU ON YOUR FIRST WRITTEN DEMAND APPROVED BY US BEFORE PRESENTATION
        REF: XXXX
        BY OUR SWIFT MT799 CONFIRMING DEFAULT, RECEIVED BY US ON OR BEFORE THE GUARANTEE EXPIRY DATE AT
        <span class="dynamic-field">{{ $bank_name}} {{ $bank_address }}</span> (“COMPLIANT DEMAND”).
    </p>
    <p>NEITHER THIS GUARANTEE NOR ANY OF YOUR RIGHTS AND BENEFITS HEREUNDER OR IN CONNECTION HEREWITH
        MAY BE ASSIGNED OR TRANSFERRED WITHOUT PRIOR WRITTEN CONSENT OF BANK.</p>
    <p>FOLLOWING THE EXPIRY DATE, THIS GUARANTEE SHALL BECOME NULL AND VOID.</p>
    <p>THIS GUARANTEE IS SUBJECT TO THE UNIFORM RULES FOR DEMAND GUARANTEES OF THE INTERNATIONAL CHAMBER
        OF COMMERCE (PUBLICATION NO. 758). FULL DETAILS TO FOLLOW UPON RECEIPT OF APPLICANT’S ACCEPTABLE
        INSTRUCTIONS AND APPLICANT’S FULFILLMENT OF OBLIGATION TOWARDS THE ISSUING BANK.</p>
    <p>FOR AND ON BEHALF OF</p>
    <p class="dynamic-field">{{ $bank_name}} </p>
    <p class="dynamic-field">{{ $bank_address }}</p>
    <p>45L: UNDERLYING TRANSACTION DETAILS</p>
    <p>AS PER CONTRACT REFERENCE NO: <span class="dynamic-field">{{ $contract_no }}</span> DATED <span class="dynamic-field">{{ $contract_date }}</span></p>
</body>

</html>