<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('pvp_statistics') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-server"></i> <?= lang('realm') ?></h3>
          </div>
          <?php if (isset($realms) && ! empty($realms)): ?>
          <ul class="uk-nav uk-nav-default" uk-switcher="connect: #realm_statistics;animation: uk-animation-fade">
            <?php foreach ($realms as $realm): ?>
            <li><a href="#"><?= $realm->name ?></a></li>
            <?php endforeach ?>
          </ul>
          <?php endif ?>
        </div>
      </div>
      <div class="uk-width-2-3@s uk-width-3-4@m">
        <?php if (isset($realms) && ! empty($realms)): ?>
        <ul id="realm_statistics" class="uk-switcher">
          <?php foreach ($realms as $realm): ?>
          <li>
            <h5 class="uk-h5 uk-text-bold uk-margin-small"><i class="fa-solid fa-trophy"></i> <?= lang('top_arena_teams') ?></h5>
            <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m" uk-grid>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <h3 class="uk-card-title"><?= lang('teams_2v2') ?></h3>
                  </div>
                  <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                      <table class="uk-table uk-table-small uk-table-divider">
                        <tbody>
                          <?php foreach ($this->pvp_model->top_teams($realm->id) as $t => $team): ?>
                          <tr>
                            <td><?= ordinal($t+1) ?></td>
                            <td>
                              <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                              <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                              <?php foreach ($this->pvp_model->team_members($realm->id, $team->arenateamid) as $member): ?>
                              <img class="uk-border-circle" src="<?= $template['assets'].'img/icons/class/'.$member->class.'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?=  $member->name ?>">
                              <?php endforeach ?>
                            </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <h3 class="uk-card-title"><?= lang('teams_3v3') ?></h3>
                  </div>
                  <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                      <table class="uk-table uk-table-small uk-table-divider">
                        <tbody>
                          <?php foreach ($this->pvp_model->top_teams($realm->id, 3) as $t => $team): ?>
                          <tr>
                            <td><?= ordinal($t+1) ?></td>
                            <td>
                              <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                              <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                              <?php foreach ($this->pvp_model->team_members($realm->id, $team->arenateamid) as $member): ?>
                              <img class="uk-border-circle" src="<?= $template['assets'].'img/icons/class/'.$member->class.'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?= $member->name ?>">
                              <?php endforeach ?>
                            </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header">
                    <h3 class="uk-card-title"><?= lang('teams_5v5') ?></h3>
                  </div>
                  <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                      <table class="uk-table uk-table-small uk-table-divider">
                        <tbody>
                          <?php foreach ($this->pvp_model->top_teams($realm->id, 5) as $t => $team): ?>
                          <tr>
                            <td><?= ordinal($t+1) ?></td>
                            <td>
                              <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                              <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                              <?php foreach ($this->pvp_model->team_members($realm->id, $team->arenateamid) as $member): ?>
                              <img class="uk-border-circle" src="<?= $template['assets'].'img/icons/class/'.$member->class.'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?= $member->name ?>">
                              <?php endforeach ?>
                            </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-text-bold uk-margin-top uk-margin-small-bottom"><i class="fa-solid fa-medal"></i> <?= lang('top_honorable_kills') ?></h5>
            <div class="uk-card uk-card-default">
              <div class="uk-card-body uk-padding-remove">
                <div class="uk-overflow-auto">
                  <table class="uk-table uk-table-small uk-table-divider">
                    <thead>
                      <tr>
                        <th class="uk-width-small"><?= lang('rank') ?></th>
                        <th class="uk-table-expand"><?= lang('name') ?></th>
                        <th class="uk-width-small"><?= lang('level') ?></th>
                        <th class="uk-width-small"><?= lang('race') ?></th>
                        <th class="uk-width-small"><?= lang('class') ?></th>
                        <th class="uk-width-small"><?= lang('total_kills') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($this->pvp_model->top_pvp($realm->id) as $p => $player): ?>
                      <tr>
                        <td><?= ordinal($p+1) ?></td>
                        <td><?= $player->name ?></td>
                        <td><?= $player->level ?></td>
                        <td><img class="uk-border-circle" src="<?= $template['assets'].'img/icons/race/'.$player->race.'-'.$player->gender.'.png' ?>" width="20" height="20" alt="<?= race_name($player->race) ?>"></td>
                        <td><img class="uk-border-circle" src="<?= $template['assets'].'img/icons/class/'.$player->class.'.png' ?>" width="20" height="20" alt="<?= class_name($player->class) ?>"></td>
                        <td><?= $player->totalKills ?></td>
                      </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </li>
          <?php endforeach ?>
        </ul>
        <?php endif ?>
      </div>
    </div>
  </div>
</section>
