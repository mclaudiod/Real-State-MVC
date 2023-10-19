<?php use Model\Agent; ?>

<?php foreach($entries as $entry): ?>

<?php $agent = Agent::find($entry->idagent); ?>

<article class="blog-entry">
    <div class="img">
        <img loading="lazy" src="/images/<?php echo $entry->img ?>" alt="Entry">
    </div>

    <div class="entry-text">
        <a href="/entry?id=<?php echo $entry->id ?>">
            <h4><?php echo $entry->title ?></h4>
            <p class="meta-information">Written on: <span><?php echo $entry->created ?></span> By: <span><?php echo esc($agent->name) . " " . esc($agent->surname); ?></span></p>
            <p><?php echo $entry->entry ?></p>
        </a>
    </div>
</article>
<?php endforeach; ?>