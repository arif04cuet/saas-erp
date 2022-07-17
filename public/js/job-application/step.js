var form = $(formContainer).show();

// jquery steps
$(formContainer).steps({
    headerTag: "h6",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    labels: labels,
    onStepChanging: function (event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }

        let validationCheck = true;

        if (newIndex == 1) {
            let input = allInputName();

            if (isEmpty(input.national_id) && isEmpty(input.birth_certificate_no)) {
                $('.err-msg').html(nationalErrMsg);
                validationCheck = false;
            } else {
                $('.err-msg').html('');
                validationCheck = true;
            }

            if (isEmpty(input.job_circular_detail_id) || isEmpty(input.applicant_name_bn) || isEmpty(input.applicant_name)
                || isEmpty(input.is_divisional_applicant.length) || isEmpty(input.birth_place) || isEmpty(input.birth_date)
                || isEmpty(input.father_name) || input.mother_name ||isEmpty(input.care_of_0) || isEmpty(input.road_and_house_0)
                || isEmpty(input.district_0) || isEmpty(input.sub_district_0) || isEmpty(input.post_office_0) || isEmpty(input.post_code_0)
                || isEmpty(input.mobile) || isEmpty(input.email) || isEmpty(input.gender.length) || isEmpty(input.religion)
                || isEmpty(input.bank_draft_no) || isEmpty(input.payment_date) || isEmpty(input.bank_draft_no)) {

                generalInputValidation();

                validationCheck = false;
            } else {
                generalInputValidation();

                validationCheck = true;
            }

            if (!(input.same_as_present.length)) {
                addSameAsPresentAddressValidation(input);

                validationCheck = false;
            } else {
                removeSameAsPresentAddressValidation(input);

                validationCheck = true;
            }

            if(input.add_experience) {
                experienceValidation(validationCheck);
            }

            if(input.add_research) {
                researchValidation(validationCheck);
            }

            educationValidation(validationCheck);

            return validationCheck;
        }

    },
    onFinished: function (event, currentIndex) {
        $(formContainer).submit();
    }
});

function isEmpty(str) {
    return (!str || 0 === str.length);
}

function addOrRemoveValidation(value, errClassName) {
    isEmpty(value) ? $(`.${errClassName}`).html(requiredMessage) : $(`.${errClassName}`).html('');
}

function addValidation(value, errClassName) {
    $(`.${errClassName}`).html(requiredMessage)
}

function removeValidation(value, errClassName) {
    $(`.${errClassName}`).html('');
}

function addSameAsPresentAddressValidation(input) {
    addValidation(input.care_of_1, 'care_of_1_err');
    addValidation(input.road_and_house_1, 'road_and_house_1_err');
    addValidation(input.district_1, 'district_1_err');
    addValidation(input.sub_district_1, 'sub_district_1_err');
    addValidation(input.post_office_1, 'post_office_1_err');
    addValidation(input.post_code_1, 'post_code_1_err');
}

function removeSameAsPresentAddressValidation(input) {
    removeValidation(input.care_of_1, 'care_of_1_err');
    removeValidation(input.road_and_house_1, 'road_and_house_1_err');
    removeValidation(input.district_1, 'district_1_err');
    removeValidation(input.sub_district_1, 'sub_district_1_err');
    removeValidation(input.post_office_1, 'post_office_1_err');
    removeValidation(input.post_code_1, 'post_code_1_err');
}

function educationValidation(validationCheck) {
    let eduErrRemoveCheck = true;

    $('.edu-level').each(function (i) {
        let name = $(this).attr('name');
        let index = name.match(/\d+/).toString();
        let level = $(`select[name="education_information[${index}][level]"]`).val();

        let exam_name = $(`select[name="education_information[${index}][exam_name]"]`).val();
        let board_or_university = $(`select[name="education_information[${index}][board_or_university]"]`).val();
        let roll = $(`input[name="education_information[${index}][roll]"]`).val();
        let grade = $(`input[name="education_information[${index}][grade]"]`).val();
        let subject = $(`input[name="education_information[${index}][subject]"]`).val();
        let passing_year = $(`select[name="education_information[${index}][passing_year]"]`).val();

        if (isEmpty(level) || isEmpty(exam_name) || isEmpty(board_or_university) || isEmpty(roll) || isEmpty(grade)
            || isEmpty(subject) || isEmpty(passing_year)) {
            $('.edu-err').html(`* ${eduErrMsg}`);
            eduErrRemoveCheck = false;
            validationCheck = false;
        }
    })

    eduErrRemoveCheck ? $('.edu-err').html(``) : '';

    return validationCheck;
}

function experienceValidation(validationCheck) {
        let exErrRemoveCheck = true;

        $('.organaization').each(function (i) {
            let name = $(this).attr('name');
            let index = name.match(/\d+/).toString();
            let organization = $(`input[name="experience_information[${index}][organization_name]"]`).val();
            let designation = $(`input[name="experience_information[${index}][designation]"]`).val();
            let length_of_service = $(`input[name="experience_information[${index}][length_of_service]"]`).val();
            let from = $(`input[name="experience_information[${index}][from]"]`).val();
            let current = $(`input[name="experience_information[${index}][currently-working][]"]`).prop('checked');
            let to = $(`input[name="experience_information[${index}][to]"]`).val();
            let responsibilities = $(`input[name="experience_information[${index}][responsibilities]"]`).val();

            if (isEmpty(organization) || isEmpty(designation) || isEmpty(length_of_service) || isEmpty(from) || isEmpty(responsibilities)
                || (!(current) && isEmpty(to)))
            {
                $('.experience-err').html(`* ${experienceErr}`);
                exErrRemoveCheck = false;
                validationCheck = false;
            }
        })

        exErrRemoveCheck ? $('.experience-err').html(``) : '';

        return validationCheck;
}

function researchValidation(validationCheck) {
    let reErrRemoveCheck = true;

    $('.research-title').each(function (i) {
        let name = $(this).attr('name');
        let index = name.match(/\d+/).toString();
        let title = $(`input[name="research_information[${index}][title]"]`).val();
        let duration = $(`input[name="research_information[${index}][duration]"]`).val();
        let from = $(`input[name="research_information[${index}][from]"]`).val();
        let to = $(`input[name="research_information[${index}][to]"]`).val();
        let supervisor = $(`input[name="research_information[${index}][supervisor]"]`).val();
        let organaization = $(`input[name="research_information[${index}][organaization]"]`).val();

        if (isEmpty(title) || isEmpty(duration) || isEmpty(from) || isEmpty(from) || isEmpty(to)
            || isEmpty(supervisor) || isEmpty(organaization))
        {
            $('.research-err').html(`* ${researchErr}`);
            reErrRemoveCheck = false;
            validationCheck = false;
        }
    })

    reErrRemoveCheck ? $('.research-err').html(``) : '';

    return validationCheck;
}

function generalInputValidation() {
    let input = allInputName();

    addOrRemoveValidation(input.job_circular_detail_id, 'job_circular_detail_id');
    addOrRemoveValidation(input.applicant_name_bn, 'applicant_name_bn_err');
    addOrRemoveValidation(input.applicant_name, 'applicant_name_en_err');
    addOrRemoveValidation(input.is_divisional_applicant.length, 'is_divisional_applicant_err');
    addOrRemoveValidation(input.birth_place, 'birth_place_err');
    addOrRemoveValidation(input.birth_date, 'birth_date_err');
    addOrRemoveValidation(input.father_name, 'father_name_err');
    addOrRemoveValidation(input.mother_name, 'mother_name_err');
    addOrRemoveValidation(input.care_of_0, 'care_of_0_err');
    addOrRemoveValidation(input.road_and_house_0, 'road_and_house_0_err');
    addOrRemoveValidation(input.district_0, 'district_0_err');
    addOrRemoveValidation(input.sub_district_0, 'sub_district_0_err');
    addOrRemoveValidation(input.post_office_0, 'post_office_0_err');
    addOrRemoveValidation(input.post_code_0, 'post_code_0_err');
    addOrRemoveValidation(input.mobile, 'mobile_err');
    addOrRemoveValidation(input.email, 'email_err');
    addOrRemoveValidation(input.gender, 'gender_err');
    addOrRemoveValidation(input.religion, 'religion_err');
    addOrRemoveValidation(input.bank_draft_no, 'bank_draft_no_err');
    addOrRemoveValidation(input.payment_date, 'payment_date_err');
    addOrRemoveValidation(input.name_of_bank_branch, 'name_of_bank_branch_err');
}

function allInputName() {
    let
        job_circular_detail_id = $('select[name="job_circular_detail_id"]').val();
        applicant_name = $('input[name="applicant_name"]').val();
        applicant_name_bn = $('input[name="applicant_name_bn"]').val();
        national_id = $('input[name="national_id"]').val();
        birth_certificate_no = $('input[name="birth_certificate_no"]').val();
        is_divisional_applicant = $("input[type='radio'][name='is_divisional_applicant']:checked");
        birth_place = $('select[name="birth_place"]').val();
        birth_date = $('input[name="birth_date"]').val();
        father_name = $('input[name="father_name"]').val();
        mother_name = $('input[name="mother_name"]').val();
        care_of_0 = $('input[name="care_of[0]"]').val();
        road_and_house_0 = $('input[name="road_and_house[0]"]').val();
        district_0 = $('select[name="district[0]"]').val();
        sub_district_0 = $('select[name="sub_district[0]"]').val();
        post_office_0 = $('input[name="post_office[0]"]').val();
        post_code_0 = $('input[name="post_code[0]"]').val();
        same_as_present = $('input[name="same_as_present"]:checked');
        care_of_1 = $('input[name="care_of[1]"]').val();
        road_and_house_1 = $('input[name="road_and_house[1]"]').val();
        district_1 = $('select[name="district[1]"]').val();
        sub_district_1 = $('select[name="sub_district[1]"]').val();
        post_office_1 = $('input[name="post_office[1]"]').val();
        post_code_1 = $('input[name="post_code[1]"]').val();
        mobile = $('input[name="mobile"]').val();
        email = $('input[name="email"]').val();
        gender = $("input[type='radio'][name='gender']:checked");
        religion = $('select[name="religion"]').val();
        add_experience = $('input[name="add_experience"]').prop('checked');
        add_research = $('input[name="add_research"]').prop('checked');
        bank_draft_no = $('input[name="bank_draft_no"]').val();
        payment_date = $('input[name="payment_date"]').val();
        name_of_bank_branch = $('input[name="name_of_bank_branch"]').val();


    return {
        'job_circular_detail_id' : job_circular_detail_id,
        'applicant_name' : applicant_name,
        'applicant_name_bn' : applicant_name_bn,
        'national_id' : national_id,
        'birth_certificate_no' : birth_certificate_no,
        'is_divisional_applicant' : is_divisional_applicant,
        'birth_place' : birth_place,
        'birth_date' : birth_date,
        'father_name' : father_name,
        'mother_name' : mother_name,
        'care_of_0' : care_of_0,
        'road_and_house_0' : road_and_house_0,
        'district_0' : district_0,
        'sub_district_0' : sub_district_0,
        'post_office_0' : post_office_0,
        'post_code_0' : post_code_0,
        'same_as_present' : same_as_present,
        'care_of_1' : care_of_1,
        'road_and_house_1' : road_and_house_1,
        'district_1' : district_1,
        'sub_district_1' : sub_district_1,
        'post_office_1' : post_office_1,
        'post_code_1' : post_code_1,
        'mobile' : mobile,
        'email' : email,
        'gender' : gender,
        'religion' : religion,
        'bank_draft_no' : bank_draft_no,
        'payment_date' : payment_date,
        'name_of_bank_branch' : name_of_bank_branch,
        'add_experience' : add_experience,
        'add_research' : add_research
    }
}
