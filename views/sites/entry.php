<?php use Model\Agent; ?>

<?php $agent = Agent::find($entry->idagent); ?>

<main class="container section centered-content">
    <h1><?php $entry->title ?></h1>

    <img loading="lazy" src="/images/<?php echo $entry->img ?>" alt="Image of the Entry">

    <p class="meta-information">Written on: <span><?php echo $entry->created ?></span> By: <span><?php echo esc($agent->name) . " " . esc($agent->surname); ?></span></p>

    <div class="property-summary">
        <p><?php echo $entry->entry ?></p>
    </div>
</main>