<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerTwLFhu1\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerTwLFhu1/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerTwLFhu1.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerTwLFhu1\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerTwLFhu1\App_KernelDevDebugContainer([
    'container.build_hash' => 'TwLFhu1',
    'container.build_id' => 'aaa48bc1',
    'container.build_time' => 1722546064,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerTwLFhu1');
