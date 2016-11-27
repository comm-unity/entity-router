<?php

namespace CommUnity\Component\EntityRouter;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

/**
 * Class Router
 * Overrides the I18n router to be able to resolve objects by route
 * component.
 */
class EntityRouter extends Router
{
    /**
     * Converts doctrine entities so they can be used as arguments to the
     * route generator.
     *
     * @param string $name
     * @param array  $parameters
     * @param int    $referenceType
     *
     * @return string
     */
    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        foreach ($parameters as $paramName => $value) {
            if ($value instanceof RoutableEntityInterface) {
                if (method_exists($value, 'getSlug')) {
                    $parameters[$paramName] = $value->getSlug();
                } elseif (method_exists($value, 'getId')) {
                    $parameters[$paramName] = $value->getId();
                }
            }
        }
        return parent::generate($name, $parameters, $referenceType);
    }
}
