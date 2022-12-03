<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pvp_model extends CI_Model
{
    /**
     * Class constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the top characters in PVP of a realm
     *
     * @param int $realm
     * @param int $limit
     * @return array
     */
    public function top_pvp($realm, $limit = 20)
    {
        return $this->server_characters_model->connect($realm)
            ->select('name, race, class, gender, level, totalKills, todayKills, yesterdayKills')
            ->where('name !=', '')
            ->order_by('totalKills', 'DESC')
            ->limit($limit)
            ->get('characters')
            ->result();
    }

    /**
     * Get the top teams in the arena
     *
     * @param int $realm
     * @param int $type
     * @param int $limit
     * @return array
     */
    public function top_teams($realm, $type = 2, $limit = 10)
    {
        $emulator = config_item('emulator');
        $database = $this->server_characters_model->connect($realm);

        if (in_array($emulator, ['cmangos', 'mangos'], true)) {
            return $database->select('arena_team.name, arena_team.arenateamid, arena_team_stats.rating, arena_team_stats.wins_season AS seasonwins')
                ->from('arena_team')
                ->join('arena_team_stats', 'arena_team.arenateamid = arena_team_stats.arenateamid')
                ->where('arena_team.type', $type)
                ->order_by('arena_team_stats.rating', 'DESC')
                ->limit($limit)
                ->get()
                ->result();
        }

        return $database->select('name, rating, seasonWins AS seasonwins, arenaTeamId AS arenateamid')
            ->where('type', $type)
            ->order_by('rating', 'DESC')
            ->limit($limit)
            ->get('arena_team')
            ->result();
    }

    /**
     * Get the arena team members of a realm
     *
     * @param int $realm
     * @param int $team
     * @return array
     */
    public function team_members($realm, $team)
    {
        $emulator = config_item('emulator');
        $database = $this->server_characters_model->connect($realm);

        if (in_array($emulator, ['cmangos', 'mangos'], true)) {
            return $database->select('arena_team_member.guid, arena_team_member.played_week AS weekgames, arena_team_member.wons_week AS weekwins, arena_team_member.played_season AS seasongames, arena_team_member.wons_season AS seasonwins, arena_team_member.personal_rating AS personalrating, characters.name, characters.race, characters.class, characters.gender')
                ->from('arena_team_member')
                ->join('characters', 'arena_team_member.guid = characters.guid')
                ->where('arena_team_member.arenateamid', $team)
                ->get()
                ->result();
        }

        return $database->select('arena_team_member.guid, arena_team_member.weekGames AS weekgames, arena_team_member.weekWins AS weekwins, arena_team_member.seasonGames AS seasongames, arena_team_member.seasonWins AS seasonwins, arena_team_member.personalRating AS personalrating, characters.name, characters.race, characters.class, characters.gender')
            ->from('arena_team_member')
            ->join('characters', 'arena_team_member.guid = characters.guid')
            ->where('arena_team_member.arenaTeamId', $team)
            ->get()
            ->result();
    }
}
