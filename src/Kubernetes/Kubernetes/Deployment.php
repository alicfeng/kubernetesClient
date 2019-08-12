<?php

/*
 * What samego team is that is 'one thing, a team, work together'
 * Value comes from technology, technology comes from sharing~
 * https://github.com/alicfeng/KubernetesClient
 * AlicFeng | a@samego.com
 */

namespace AlicFeng\Kubernetes\Kubernetes;

use AlicFeng\Kubernetes\Base\KubernetesClient;
use AlicFeng\Kubernetes\Base\KubernetesManagerIf;

/**
 * Class Deployment | 应用部署管理类.
 */
class Deployment extends KubernetesClient implements KubernetesManagerIf
{
    public function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    /**
     * @function    新建资源项
     * @description 新建资源项
     *
     * @param array $package 期待的资源配置
     *
     * @return $this
     */
    public function create(array $package = [])
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments";

        return $this->_create($uri, self::TYPE_DEPLOYMENT, $package);
    }

    /**
     * @function    修改资源项
     * @description 修改指定资源项
     *
     * @param string $name    资源名称
     * @param array  $package 期待的资源配置
     *
     * @return $this
     */
    public function apply(string $name, array $package = [])
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments/{$name}";

        return $this->_apply($uri, self::TYPE_DEPLOYMENT, $package);
    }

    /**
     * @function    删除资源项
     * @description 删除指定资源项
     *
     * @param string $name 资源名称
     *
     * @return $this
     */
    public function remove(string $name)
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments/{$name}";

        return $this->_remove($uri);
    }

    /**
     * @function    查询资源列表结合
     * @description 默认为具体的默认命名空间
     *
     * @param bool $is_all_namespace 是否为所有命名空间
     *
     * @return $this
     */
    public function list(bool $is_all_namespace = false)
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments";
        if ($is_all_namespace) {
            $uri = '/apis/apps/v1/deployments';
        }

        return $this->_list($uri);
    }

    /**
     * @function    查询资源列表结合
     * @description 默认为具体的默认命名空间
     *
     * @param string $name 资源名称
     *
     * @return $this
     */
    public function queryStatus(string $name)
    {
        $uri = "/apis/app s/v1/namespaces/{$this->namespace}/deployments/{$name}/status";

        return $this->_queryStatus($uri);
    }

    /**
     * @function    查看应用部署节点数量
     * @description 查看节点数量
     *
     * @param string $name
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \AlicFeng\Kubernetes\Exception\CommunicationException
     */
    public function getScale(string $name)
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments/{$name}/scale";

        $this->response = $this->get($uri);

        return $this->response();
    }

    /**
     * @function    设置应用部署节点数量
     * @description 设置应用部署节点数量
     *
     * @param string $name    应用部署名称
     * @param array  $package 资源声明内容
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \AlicFeng\Kubernetes\Exception\CommunicationException
     */
    public function setScale(string $name, array $package = [])
    {
        $uri = "/apis/apps/v1/namespaces/{$this->namespace}/deployments/{$name}/scale";

        $this->commonPackage(self::TYPE_DEPLOYMENT, $package);
        $this->response = $this->put($uri);

        return $this->response();
    }
}