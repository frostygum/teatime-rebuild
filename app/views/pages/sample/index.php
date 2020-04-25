<?= $this::add_template('header') ?>

<h6 class="text-center">Here are sample to all components</h6>

<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0">Button</h6>
        </div>
        <div class="card-content">
            <span>Normal Button</span>
            <div class="display-grid grid-col-4 grid-g-1 mb-1">
                <button class="btn">default</button>
                <button class="btn btn-primary">primary</button>
                <button class="btn btn-success">success</button>
                <button class="btn btn-warning">warning</button>
                <button class="btn btn-danger">danger</button>
                <button class="btn btn-info">info</button>
                <button class="btn btn-dark">dark</button>
            </div>
            
            <span>Large Button</span>
            <div class="display-grid grid-col-4 grid-g-1 mb-1">
                <button class="btn btn-lg">default</button>
                <button class="btn btn-lg btn-primary">primary</button>
                <button class="btn btn-lg btn-success">success</button>
                <button class="btn btn-lg btn-warning">warning</button>
                <button class="btn btn-lg btn-danger">danger</button>
                <button class="btn btn-lg btn-info">info</button>
                <button class="btn btn-lg btn-dark">dark</button>
            </div>

            <span>Disabled Button</span>
            <div class="display-grid grid-col-4 grid-g-1">
                <button class="btn" disabled>default</button>
                <button class="btn btn-primary" disabled>primary</button>
                <button class="btn btn-success" disabled>success</button>
                <button class="btn btn-warning" disabled>warning</button>
                <button class="btn btn-danger" disabled>danger</button>
                <button class="btn btn-info" disabled>info</button>
                <button class="btn btn-dark" disabled>dark</button>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0">Input</h6>
        </div>
        <div class="card-content">
            <div class="display-grid grid-col-4 grid-g-1">
                <input type="text" class="input" placeholder="default" />
                <input type="text" class="input error" placeholder="error" />
                <input type="text" class="input success" placeholder="success" />
                <input type="text" class="input disabled" disabled placeholder="disabled" />
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0">Typography</h6>
        </div>
        <div class="card-content">
            <h1>Heading 1</h1>
            <h2>Heading 2</h2>
            <h3>Heading 3</h3>
            <h4>Heading 4</h4>
            <h5>Heading 5</h5>
            <h6>Heading 6</h6>
            <p>This is a sample of a paragraph</p>
        </div>
    </div>
</div>

<?= $this::add_template('footer') ?>