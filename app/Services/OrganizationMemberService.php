<?php

namespace App\Services;

use Closure;
use App\Entities\Organization\OrganizationMember;
use App\Repositories\Organization\OrganizationMemberRepository;
use App\Traits\CrudTrait;
use App\Utilities\DropDownDataFormatter;
use Carbon\Carbon;

class OrganizationMemberService
{
    use CrudTrait;

    private $organizationMemberRepository;

    public function __construct(OrganizationMemberRepository $organizationMemberRepository)
    {
        $this->organizationMemberRepository = $organizationMemberRepository;
        $this->setActionRepository($this->organizationMemberRepository);
    }

    public function store(array $data)
    {
        $data = $this->parseDOB($data);

        return $this->save($data);
    }

    public function updateMember(OrganizationMember $member, array $data)
    {
        $data = $this->parseDOB($data);

        return $this->update($member, $data);
    }

    /**
     * @param array $data
     * @return array
     */
    private function parseDOB(array $data): array
    {
        if (!empty($data['dob'])) {
            $data['dob'] = Carbon::createFromFormat('d/m/Y', $data['dob']);
        }
        return $data;
    }

    public function getMembersForDropdown(
        Closure $implementedValue = null,
        Closure $implementedKey = null,
        array $query = null,
        $isEmptyOption = false
    ) {
        $members = $query ? $this->organizationMemberRepository->findBy($query) : $this->organizationMemberRepository->findAll();
        return DropDownDataFormatter::getFormattedDataForDropdown(
            $members,
            $implementedKey,
            $implementedValue ?: function ($member) {
                return $member->name;
            },
            $isEmptyOption
        );
    }

    public function getMembers($query)
    {
        return $members = $this->organizationMemberRepository->findBy($query);
    }
}
