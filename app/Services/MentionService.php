<?php
/**
 * Created by PhpStorm.
 * User: jacob
 * Date: 2017/3/17
 * Time: 11:03
 */

namespace App\Services;


use App\Models\User;

/**
 * Class MentionService
 * @package App\Services
 */
class MentionService
{

    /**
     * @var
     */
    public $body_parsed;
    /**
     * @var array
     */
    public $users = [];
    /**
     * @var
     */
    public $usernames;
    /**
     * @var
     */
    public $body_original;

    /**
     * @return array
     */
    public function getMentionedUsername()
    {
        preg_match_all("/(\S*)\@([^\r\n\s]*)/i", $this->body_original, $atlist_tmp);
        $usernames = [];
        foreach ($atlist_tmp[2] as $k=>$v) {
            if ($atlist_tmp[1][$k] || strlen($v) >25) {
                continue;
            }
            $usernames[] = $v;
        }
        return array_unique($usernames);
    }

    /**
     *
     */
    public function replace()
    {
        $this->body_parsed = $this->body_original;

        foreach ($this->users as $user) {
            $search = '@' . $user->name;
            $place = '['.$search.']('.route('users.show', $user->id).')';
            $this->body_parsed = str_replace($search, $place, $this->body_parsed);
        }
    }

    /**
     * @param $body
     * @return mixed
     */
    public function parse($body)
    {
        $this->body_original = $body;

        $this->usernames = $this->getMentionedUsername();
        count($this->usernames) > 0 && $this->users = User::whereIn('name', $this->usernames)->get();

        $this->replace();
        return $this->body_parsed;
    }

}