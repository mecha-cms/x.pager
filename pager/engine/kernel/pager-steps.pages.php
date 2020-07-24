<?php namespace PagerSteps;

class Pages extends \Pager\Pages {

    const range = '&#x2026;';

    public $steps;

    public function __construct(array $data = [], $chunk = [5, 0], $parent = null) {
        parent::__construct($data, $chunk, $parent);
        $top = $this->parent->link ?? $this->parent->url ?? null;
        $peek = 2;
        $count = \count($data);
        $current = ($chunk[1] ?? 0) + 1;
        $begin = 1;
        $end = (int) \ceil($count / ($chunk[0] ?? 5));
        $this->steps = [];
        $index = -1;
        if ($end > 1) {
            if ($current <= $peek + $peek) {
                $min = $begin;
                $max = \min($begin + $peek + $peek, $end);
            } else if ($current > $end - $peek - $peek) {
                $min = $end - $peek - $peek;
                $max = $end;
            } else {
                $min = $current - $peek;
                $max = $current + $peek;
            }
            if ($min > $begin) {
                $this->steps[++$index] = $top . '/' . $begin;
                if ($min > $begin + 1) {
                    $this->steps[++$index] = "";
                }
            }
            for ($i = $min; $i <= $max; ++$i) {
                if ($current === $i) {
                    $this->steps['#'] = $top . '/' . $i;
                    ++$index;
                } else {
                    $this->steps[++$index] = $top . '/' . $i;
                }
            }
            if ($max < $end) {
                if ($max < $end - 1) {
                    $this->steps[++$index] = "";
                }
                $this->steps[++$index] = $top . '/' . $end;
            }
        }
    }

    public function next(string $text = null) {
        return \strtr(parent::next($text), [
            '<span>' => '<b>',
            '</span>' => '</b>'
        ]);
    }

    public function prev(string $text = null) {
        return \strtr(parent::prev($text), [
            '<span>' => '<b>',
            '</span>' => '</b>'
        ]);
    }

    public function steps(string $text = null) {
        if (null === $text) {
            return $this->steps;
        }
        $out = [];
        $url = $this->base;
        $q = strtr($url->query . "", ['&' => '&amp;']);
        $h = $url->hash . "";
        $r = 'prev';
        foreach ($this->steps as $k => $v) {
            $parts = explode('/', $v);
            if ('#' === $k) {
                $out[] = '<b>' . array_pop($parts) . '</b>';
                $r = 'next';
            } else if ("" === $v) {
                $out[] = '<span>' . self::range . '</span>';
            } else {
                $out[] = '<a href="' . $v . $q . $h . '" rel="' . $r . '">' . array_pop($parts) . '</a>';
            }
        }
        unset($parts);
        return implode(' ', $out);
    }

}
