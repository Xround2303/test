export default class LinkSliderManager
{
    constructor(domain)
    {
        this.domain = domain;
        this.availablePath = /^\/(crm\/(deal|lead|contact|company|type)|marketplace|company\/personal\/user\/[0-9]+|workgroups\/group\/[0-9]+)\//;
    }

    check(path)
    {
        return this.availablePath.test(this.transformPath(path))
    }

    clearDomainProtocol(absolutePath)
    {
        let path = absolutePath.replace(`https://${this.domain}`, '')
        return path.replace(`http://${this.domain}`, '');
    }

    open(pathAbsolute)
    {
        let pathRelated = this.transformPath(pathAbsolute);

        if(BX24 && this.check(pathRelated)) {
            return BX24?.openPath(pathRelated);
        }

        if(!BX24 && this.check(pathRelated)) {
            window.open(pathAbsolute)
        }
    }

    transformPath(path)
    {
        return this.clearDomainProtocol(path)
    }

    start()
    {
        document.addEventListener('click', (e) => {
            let current = e.target;
            while (current != document.body) {
                if (current?.tagName == 'A') {

                    if(this.check(current.href)) {
                        e.preventDefault();
                        this.open(current.href)
                    }

                    break;
                } else {
                    if(!current) {
                        break;
                    }

                    current = current.parentNode;
                }
            }
        });
    }
}