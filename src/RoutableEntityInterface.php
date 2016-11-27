<?php

namespace CommUnity\Component\EntityRouter;

/**
 * Marker interface to resolve an entity from a route through
 * the persistence layer.
 */
interface RoutableEntityInterface
{
    public function getId();
}
