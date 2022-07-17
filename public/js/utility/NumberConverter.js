/*
File Added By imran16-bs
email: imran.hossain@brainstation-23.com
 */

//--------------------------- Convert to En Words -----------------------------------------------------------------
var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

let convertToEnWords =
    {
        convert: function convertEnWords(num) {
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return;
            var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : 'Zero';
            return  str;
        }
    }

// ------------------- digit convertion ------------------------------------------------------
const numbersB = {
    '০': 0,
    '১': 1,
    '২': 2,
    '৩': 3,
    '৪': 4,
    '৫': 5,
    '৬': 6,
    '৭': 7,
    '৮': 8,
    '৯': 9
};

const numbersE = {
    0: '০',
    1: '১',
    2: '২',
    3: '৩',
    4: '৪',
    5: '৫',
    6: '৬',
    7: '৭',
    8: '৮',
    9: '৯'
};

function bnToEnNumber(input) {
    let output = [];
    for (let i = 0; i < input.length; ++i) {
        if (numbersB.hasOwnProperty(input[i])) {
            output.push(numbersB[input[i]]);
        } else {
            output.push(input[i]);
        }
    }
    return output.join('');
}

function enToBnNumber(input) {
    let output = [];
    for (let i = 0; i < input.length; ++i) {
        if (numbersE.hasOwnProperty(input[i])) {
            output.push(numbersE[input[i]]);
        } else {
            output.push(input[i]);
        }
    }
    return output.join('');
}
// -------------------- convert to bn words ------------------------------------

/**
 * Code courtesy: https://github.com/tsaqib/number-to-bangla/blob/master/number-to-bangla.js (Ex: Bs-23 COO)
 * @type {{convert: (function(*=): string), numtow: {"88": string, "89": string, "90": string, "91": string, "92": string, "93": string, "94": string, "95": string, "96": string, "97": string, "10": string, "98": string, "11": string, "99": string, "12": string, "13": string, "14": string, "15": string, "16": string, "17": string, "18": string, "19": string, "0": string, "1": string, "2": string, "3": string, "4": string, "400": string, "5": string, "6": string, "7": string, "8": string, "800": string, "9": string, "20": string, "21": string, "22": string, "23": string, "24": string, "25": string, "26": string, "27": string, "28": string, "29": string, "30": string, "31": string, "32": string, "33": string, "34": string, "35": string, "36": string, "37": string, "38": string, "39": string, "300": string, "700": string, "40": string, "41": string, "42": string, "43": string, "44": string, "45": string, "46": string, "47": string, "48": string, "49": string, "50": string, "51": string, "52": string, "53": string, "54": string, "55": string, "56": string, "57": string, "58": string, "59": string, "200": string, "600": string, "60": string, "61": string, "62": string, "63": string, "64": string, "65": string, "66": string, "67": string, "68": string, "69": string, "70": string, "71": string, "72": string, "73": string, "74": string, "75": string, "76": string, "77": string, "78": string, "79": string, "100": string, "500": string, "80": string, "81": string, "900": string, "82": string, "83": string, "84": string, "85": string, "86": string, "87": string}, determinant: {"": (function(*): boolean), অজুত: (function(*): boolean), কোটি: (function(*): boolean), হাজার: (function(*): boolean), নিজুত: (function(*): boolean), শত: (function(*): boolean), লাখ: (function(*): boolean)}}}
 */
let convertToBnWords = {
    numtow: {
        '0': 'শুন্য',
        '1': 'এক',
        '2': 'দুই',
        '3': 'তিন',
        '4': 'চার',
        '5': 'পাঁচ',
        '6': 'ছয়',
        '7': 'সাত',
        '8': 'আট',
        '9': 'নয়',
        '10': 'দশ',
        '11': 'এগারো',
        '12': 'বারো',
        '13': 'তেরো',
        '14': 'চৌদ্দ',
        '15': 'পনেরো',
        '16': 'ষোল',
        '17': 'সতেরো',
        '18': 'আঠারো',
        '19': 'ঊনিশ',
        '20': 'বিশ',
        '21': 'একুশ',
        '22': 'বাইশ',
        '23': 'তেইশ',
        '24': 'চব্বিশ',
        '25': 'পঁচিশ',
        '26': 'ছাব্বিশ',
        '27': 'সাতাশ',
        '28': 'আঠাশ',
        '29': 'ঊনত্রিশ',
        '30': 'ত্রিশ',
        '31': 'একত্রিশ',
        '32': 'বত্রিশ',
        '33': 'তেত্রিশ',
        '34': 'চৌত্রিশ',
        '35': 'পঁয়ত্রিশ',
        '36': 'ছত্রিশ',
        '37': 'সাইত্রিশ',
        '38': 'আটত্রিশ',
        '39': 'ঊনচল্লিশ',
        '40': 'চল্লিশ',
        '41': 'একচল্লিশ',
        '42': 'বিয়াল্লিশ',
        '43': 'তেতাল্লিশ',
        '44': 'চুয়াল্লিশ',
        '45': 'পঁয়তাল্লিশ',
        '46': 'ছেচল্লিশ',
        '47': 'সাতচল্লিশ',
        '48': 'আটচল্লিশ',
        '49': 'ঊনপঞ্চাশ',
        '50': 'পঞ্চাশ',
        '51': 'একান্ন',
        '52': 'বায়ান্ন',
        '53': 'তিপ্পান্ন',
        '54': 'চুয়ান্ন',
        '55': 'পঞ্চান্ন',
        '56': 'ছাপ্পান্ন',
        '57': 'সাতান্ন',
        '58': 'আটান্ন',
        '59': 'ঊনষাট',
        '60': 'ষাট',
        '61': 'একষট্টি',
        '62': 'বাষট্টি',
        '63': 'তেষট্টি',
        '64': 'চৌষট্টি',
        '65': 'পঁয়ষট্টি',
        '66': 'ছেষট্টি',
        '67': 'সাতষট্টি',
        '68': 'আটষট্টি',
        '69': 'ঊনসত্তর',
        '70': 'সত্তর',
        '71': 'একাত্তর',
        '72': 'বাহাত্তর',
        '73': 'তিয়াত্তর',
        '74': 'চুয়াত্তর',
        '75': 'পঁচাত্তর',
        '76': 'ছিয়াত্তর',
        '77': 'সাতাত্তর',
        '78': 'আটাত্তর',
        '79': 'ঊনআশি',
        '80': 'আশি',
        '81': 'একাশি',
        '82': 'বিরাশি',
        '83': 'তিরাশি',
        '84': 'চুরাশি',
        '85': 'পঁচাশি',
        '86': 'ছিয়াশি',
        '87': 'সাতাশি',
        '88': 'আটাশি',
        '89': 'ঊননব্বই',
        '90': 'নব্বই',
        '91': 'একানব্বই',
        '92': 'বিরানব্বই',
        '93': 'তিরানব্বই',
        '94': 'চুরানব্বই',
        '95': 'পঁচানব্বই',
        '96': 'ছিয়ানব্বই',
        '97': 'সাতানব্বই',
        '98': 'আটানব্বই',
        '99': 'নিরানব্বই',
        '100': 'একশো',
        '200': 'দুইশো',
        '300': 'তিনশো',
        '400': 'চারশো',
        '500': 'পাঁচশো',
        '600': 'ছয়শো',
        '700': 'সাতশো',
        '800': 'আটশো',
        '900': 'নয়শো'
    },

    /* ES6 version contributed by Swagata Prateek */
    determinant: {
        '': (numLength) => numLength < 3,
        'শত': (numLength) => numLength == 3,
        'হাজার': (numLength) => numLength == 4,
        'অজুত': (numLength) => numLength == 5,
        'লাখ': (numLength) => numLength == 6,
        'নিজুত': (numLength) => numLength == 7,
        'কোটি': (numLength) => numLength >= 8
    },

    convert: function (num) {
        var self = this;

        // local functions
        var isInteger = function (value) {
            return typeof value === 'number' &&
                isFinite(value) &&
                Math.floor(value) === value;
        }

        var digits = (number) => Math.log(number) * Math.LOG10E + 1 | 0;
        var isNegative = (number) => number < 0;
        var split = (number, count) => {
            // Doing math operations in JS, I must have guts
            // Replace with string operations if need be. Wanted to do some perf test
            var digitCount = digits(number);
            count = Math.min(digitCount, count);
            var decpower = 10 ** (digitCount - count);
            var retArr = [Math.floor(number / decpower)]

            if (count !== digitCount) retArr.push(number % decpower);
            return retArr;
        };

        var hasDet = (numLength, determinant) => Object
            .keys(determinant)
            .find(key => determinant[key](numLength));

        var convertInternal = function (number) {
            numLength = digits(number);
            var det = hasDet(numLength, self.determinant);

            var numSplit = [];
            var midterm = '';
            var firstTerm = '';

            if (det) {
                if (det !== 'কোটি') {
                    switch (det) {
                        case 'শত':
                            numSplit = split(number, 1);
                            numSplit[0] = numSplit[0] * 100;
                            break;
                        case 'হাজার':
                            numSplit = split(number, 1);
                            midterm = 'হাজার';
                            break;
                        case 'অজুত':
                            numSplit = split(number, 2);
                            midterm = 'হাজার';
                            break;
                        case 'লাখ':
                            numSplit = split(number, 1);
                            midterm = 'লাখ';
                            break;
                        case 'নিজুত':
                            numSplit = split(number, 2);
                            midterm = 'লাখ';
                            break;
                    }
                    firstTerm = self.numtow[numSplit[0].toString()];
                } else {
                    numSplit = split(number, numLength - 7);
                    midterm = 'কোটি';
                    // recurse again to get the first term with out split
                    firstTerm = convertInternal(numSplit[0]);
                }

                return [
                    firstTerm,
                    midterm,
                    numSplit[1] === 0 ? '' : convertInternal(numSplit[1])
                ].filter(x => x.length > 0).join(" ")
            } else {
                return self.numtow[number.toString()];
            }
        }

        if (!isInteger(num))
            throw new Error("Invalid argument num, expected number, encountered " + typeof num);

        if (isNegative(num))
            throw new Error("Expected positive integer, encountered negative integer");

        return convertInternal(num);
    }
}
